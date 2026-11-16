<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Services\ActivityHeatmapService;
use App\Services\ProgressService;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function dashboard(ProgressService $progress, ActivityHeatmapService $heatmap)
    {
        return $this->courseView('student.dashboard', $progress, $heatmap);
    }

    public function courses(ProgressService $progress)
    {
        return $this->courseView('student.courses', $progress);
    }

    public function orders()
    {
        $orders = request()->user()->orders()->with('course')->latest()->paginate(12);

        return view('student.orders', compact('orders'));
    }

    private function courseView(string $view, ProgressService $progress, ?ActivityHeatmapService $heatmap = null)
    {
        $user = request()->user();
        $courses = $user->enrolledCourses()->with(['category', 'sections.lessons', 'exams'])->wherePivot('status', 'active')->latest('course_user.enrolled_at')->paginate(9);
        $courseIds = $courses->getCollection()->pluck('id');
        $attempts = $user->examAttempts()->with('exam')->whereHas('exam', fn ($query) => $query->whereIn('course_id', $courseIds))->get();
        $progressByCourse = $courses->getCollection()->mapWithKeys(fn ($course) => [$course->id => $progress->percent($user, $course)]);
        $courseDetails = $courses->getCollection()->mapWithKeys(function ($course) use ($user, $attempts) {
            $lessonIds = $course->sections->flatMap->lessons->pluck('id');
            $completedLessons = $user->completedLessons()->whereIn('lessons.id', $lessonIds)->count();
            $nonFinalExams = $course->exams->where('is_final', false)->where('status', 'published');
            $quizAttempts = $attempts->whereIn('exam_id', $nonFinalExams->pluck('id'))->where('status', 'submitted');
            $quizStatus = $nonFinalExams->isEmpty() ? 'Không có' : ($quizAttempts->contains('passed', true) ? 'Đã đạt' : 'Chưa đạt');
            $finalExam = $course->exams->firstWhere('is_final', true);
            $finalAttempt = $finalExam ? $attempts->where('exam_id', $finalExam->id)->where('status', 'submitted')->sortByDesc('submitted_at')->first() : null;
            $finalStatus = ! $finalExam ? 'Chưa có' : (! $finalAttempt ? 'Chưa thi' : ($finalAttempt->passed ? 'Hoàn tất' : 'Chưa đạt ('.number_format((float) $finalAttempt->score, 1, ',', '.').'%)'));

            return [$course->id => ['completed' => $completedLessons, 'total' => $lessonIds->count(), 'quiz_status' => $quizStatus, 'final_status' => $finalStatus]];
        });
        $certificatesByCourse = $user->certificates()->get()->keyBy('course_id');
        $stats = [
            'active' => $user->enrolledCourses()->wherePivot('status', 'active')->count(),
            'completed' => $user->enrolledCourses()->wherePivotNotNull('completed_at')->count(),
            'certificates' => $certificatesByCourse->count(),
            'attempts' => $user->examAttempts()->where('status', 'submitted')->count(),
        ];

        $learningCount = $progressByCourse->filter(fn ($value) => $value < 100)->count();
        $completedCount = $progressByCourse->filter(fn ($value) => $value >= 100)->count();
        $extra = compact('courseDetails', 'learningCount', 'completedCount');

        if ($view === 'student.dashboard') {
            $lessonActivity = DB::table('lesson_user')->where('user_id', $user->id)->pluck('completed_at');
            $examActivity = $user->examAttempts()->whereNotNull('submitted_at')->pluck('submitted_at');
            $activityDays = $heatmap->build($lessonActivity, $examActivity);
            $latestByCourse = DB::table('lesson_user')
                ->join('lessons', 'lessons.id', '=', 'lesson_user.lesson_id')
                ->join('sections', 'sections.id', '=', 'lessons.section_id')
                ->where('lesson_user.user_id', $user->id)
                ->whereNotNull('lesson_user.completed_at')
                ->get(['sections.course_id', 'lesson_user.completed_at'])
                ->groupBy('course_id')->map(fn ($rows) => $rows->max('completed_at'));
            $continueCourses = $courses->getCollection()->filter(fn ($course) => $progressByCourse[$course->id] < 100)
                ->sortByDesc(fn ($course) => $latestByCourse->get($course->id, $course->pivot->enrolled_at))
                ->take(3)->values();
            $nextLessonByCourse = $courses->getCollection()->mapWithKeys(fn ($course) => [$course->id => $progress->nextLesson($user, $course)]);
            $upcomingItems = collect();
            foreach ($courses->getCollection() as $course) {
                if ($upcomingItems->count() >= 4) {
                    break;
                }
                $finalExam = $course->exams->firstWhere('is_final', true);
                $finalPassed = $finalExam && $attempts->where('exam_id', $finalExam->id)->contains('passed', true);
                $availableQuiz = $course->exams->where('is_final', false)->where('status', 'published')
                    ->first(fn ($exam) => ! $attempts->where('exam_id', $exam->id)->contains('passed', true));
                if ($progressByCourse[$course->id] >= 100 && $finalExam && ! $finalPassed) {
                    $upcomingItems->push(['type' => 'exam', 'label' => 'Thi cuối khóa', 'title' => $finalExam->title, 'course' => $course, 'url' => route('exams.show', $finalExam)]);
                } elseif ($availableQuiz) {
                    $upcomingItems->push(['type' => 'exam', 'label' => 'Bài kiểm tra', 'title' => $availableQuiz->title, 'course' => $course, 'url' => route('exams.show', $availableQuiz)]);
                } elseif ($nextLesson = $nextLessonByCourse->get($course->id)) {
                    $upcomingItems->push(['type' => 'lesson', 'label' => 'Bài tiếp theo', 'title' => $nextLesson->title, 'course' => $course, 'url' => route('learn.show', [$course, $nextLesson])]);
                }
            }
            $extra += compact('activityDays', 'continueCourses', 'nextLessonByCourse', 'upcomingItems');
        }

        return view($view, compact('courses', 'progressByCourse', 'certificatesByCourse', 'stats') + $extra);
    }
}
