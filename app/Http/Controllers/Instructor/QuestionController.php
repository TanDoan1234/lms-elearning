<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Instructor\QuestionRequest;
use App\Models\Course;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class QuestionController extends Controller
{
    private function authorizeCourse(Course $course): void
    {
        abort_unless(auth()->user()->isAdmin() || $course->instructor_id === auth()->id(), 403);
    }

    private function ensureNested(Course $course, Question $question): void
    {
        abort_unless($question->course_id === $course->id, 404);
    }

    public function index(Request $request, Course $course): View
    {
        $this->authorizeCourse($course);
        Gate::authorize('viewAny', Question::class);
        $questions = $course->questions()->with('options')->withCount('exams')
            ->when($request->filled('type'), fn ($q) => $q->where('type', $request->string('type')))
            ->when($request->filled('difficulty'), fn ($q) => $q->where('difficulty', $request->string('difficulty')))
            ->when($request->filled('search'), fn ($q) => $q->where('content', 'like', '%'.$request->string('search').'%'))
            ->latest()->paginate(15)->withQueryString();

        return view('instructor.questions.index', compact('course', 'questions'));
    }

    public function create(Course $course): View
    {
        $this->authorizeCourse($course);
        Gate::authorize('create', Question::class);

        return view('instructor.questions.create', compact('course'));
    }

    public function store(QuestionRequest $request, Course $course): RedirectResponse
    {
        $this->authorizeCourse($course);
        Gate::authorize('create', Question::class);
        $question = DB::transaction(function () use ($request, $course) {
            $question = $course->questions()->create($request->safe()->except(['options', 'correct_options']) + ['created_by' => auth()->id()]);
            $question->options()->createMany($request->validated('options'));

            return $question;
        });

        return redirect()->route('instructor.courses.questions.show', [$course, $question])->with('success', 'Đã tạo câu hỏi.');
    }

    public function show(Course $course, Question $question): View
    {
        $this->ensureNested($course, $question);
        Gate::authorize('view', $question);
        $question->load('options');

        return view('instructor.questions.show', compact('course', 'question'));
    }

    public function edit(Course $course, Question $question): View
    {
        $this->ensureNested($course, $question);
        Gate::authorize('update', $question);
        $question->load('options');

        return view('instructor.questions.edit', compact('course', 'question'));
    }

    public function update(QuestionRequest $request, Course $course, Question $question): RedirectResponse
    {
        $this->ensureNested($course, $question);
        Gate::authorize('update', $question);
        DB::transaction(function () use ($request, $question) {
            $question->update($request->safe()->except(['options', 'correct_options']));
            $question->options()->delete();
            $question->options()->createMany($request->validated('options'));
        });

        return redirect()->route('instructor.courses.questions.show', [$course, $question])->with('success', 'Đã cập nhật câu hỏi.');
    }

    public function destroy(Course $course, Question $question): RedirectResponse
    {
        $this->ensureNested($course, $question);
        Gate::authorize('delete', $question);
        if ($question->exams()->exists()) {
            return back()->with('error', 'Không thể xoá câu hỏi đang được sử dụng trong đề thi. Hãy gỡ câu hỏi khỏi đề thi trước.');
        }
        $question->delete();

        return redirect()->route('instructor.courses.questions.index', $course)->with('success', 'Đã xoá câu hỏi.');
    }
}
