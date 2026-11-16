<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Instructor\ExamRequest;
use App\Models\Course;
use App\Models\Exam;
use App\Services\ExamBuilderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ExamController extends Controller
{
    public function __construct(private readonly ExamBuilderService $builder) {}

    private function own(Course $course): void
    {
        abort_unless(auth()->user()->isAdmin() || $course->instructor_id === auth()->id(), 403);
    }

    private function nested(Course $course, Exam $exam): void
    {
        abort_unless($exam->course_id === $course->id, 404);
    }

    public function index(Course $course): View
    {
        $this->own($course);
        Gate::authorize('viewAny', Exam::class);
        $exams = $course->exams()->withCount(['questions', 'attempts'])->latest()->paginate(15);

        return view('instructor.exams.index', compact('course', 'exams'));
    }

    public function create(Course $course): View
    {
        $this->own($course);
        Gate::authorize('create', Exam::class);
        $questions = $course->questions()->with('options')->get();

        return view('instructor.exams.create', compact('course', 'questions'));
    }

    public function store(ExamRequest $request, Course $course): RedirectResponse
    {
        $this->own($course);
        Gate::authorize('create', Exam::class);
        $exam = DB::transaction(function () use ($request, $course) {
            if ($request->boolean('is_final')) {
                $course->exams()->where('is_final', true)->update(['is_final' => false]);
            }
            $exam = $course->exams()->create($request->safe()->except(['selection_mode', 'questions', 'random']));
            $request->string('selection_mode')->value() === 'random' ? $this->builder->random($exam, $request->validated('random')) : $this->builder->manual($exam, $request->validated('questions', []));

            return $exam;
        });

        return redirect()->route('instructor.courses.exams.show', [$course, $exam])->with('success', 'Đã tạo đề thi.');
    }

    public function show(Course $course, Exam $exam): View
    {
        $this->nested($course, $exam);
        Gate::authorize('view', $exam);
        $exam->load(['questions.options'])->loadCount('attempts');

        return view('instructor.exams.show', compact('course', 'exam'));
    }

    public function edit(Course $course, Exam $exam): View
    {
        $this->nested($course, $exam);
        Gate::authorize('update', $exam);
        $exam->load('questions');
        $questions = $course->questions()->with('options')->get();

        return view('instructor.exams.edit', compact('course', 'exam', 'questions'));
    }

    public function update(ExamRequest $request, Course $course, Exam $exam): RedirectResponse
    {
        $this->nested($course, $exam);
        Gate::authorize('update', $exam);
        DB::transaction(function () use ($request, $course, $exam) {
            if ($request->boolean('is_final')) {
                $course->exams()->where('is_final', true)->whereKeyNot($exam->id)->update(['is_final' => false]);
            }
            $exam->update($request->safe()->except(['selection_mode', 'questions', 'random']));
            $request->string('selection_mode')->value() === 'random' ? $this->builder->random($exam, $request->validated('random')) : $this->builder->manual($exam, $request->validated('questions', []));
        });

        return redirect()->route('instructor.courses.exams.show', [$course, $exam])->with('success', 'Đã cập nhật đề thi.');
    }

    public function destroy(Course $course, Exam $exam): RedirectResponse
    {
        $this->nested($course, $exam);
        Gate::authorize('delete', $exam);
        $exam->delete();

        return redirect()->route('instructor.courses.exams.index', $course)->with('success', 'Đã xoá đề thi.');
    }
}
