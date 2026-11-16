<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Instructor\LessonRequest;
use App\Models\Lesson;
use App\Models\Section;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    public function index(Section $section)
    {
        Gate::authorize('view', $section);
        $section->load('course', 'lessons');

        return view('instructor.lessons.index', compact('section'));
    }

    public function create(Section $section)
    {
        Gate::authorize('update', $section);

        return view('instructor.lessons.form', ['section' => $section, 'lesson' => new Lesson]);
    }

    public function store(LessonRequest $r, Section $section)
    {
        Gate::authorize('update', $section);
        $d = $this->data($r);
        $d['position'] = $d['position'] ?? ($section->lessons()->max('position') + 1);
        $section->lessons()->create($d);

        return redirect()->route('instructor.courses.show', $section->course)->with('success', 'Đã thêm bài học.');
    }

    public function show(Lesson $lesson)
    {
        Gate::authorize('view', $lesson);
        $lesson->load('section.course');

        return view('instructor.lessons.show', compact('lesson'));
    }

    public function edit(Lesson $lesson)
    {
        Gate::authorize('update', $lesson);

        return view('instructor.lessons.form', ['section' => $lesson->section, 'lesson' => $lesson]);
    }

    public function update(LessonRequest $r, Lesson $lesson)
    {
        Gate::authorize('update', $lesson);
        $lesson->update($this->data($r, $lesson));

        return redirect()->route('instructor.courses.show', $lesson->section->course)->with('success', 'Đã cập nhật bài học.');
    }

    public function destroy(Lesson $lesson)
    {
        Gate::authorize('delete', $lesson);
        $course = $lesson->section->course;
        $this->deleteFiles($lesson);
        $lesson->delete();

        return redirect()->route('instructor.courses.show', $course)->with('success', 'Đã xóa bài học.');
    }

    private function data(LessonRequest $r, ?Lesson $old = null): array
    {
        $d = $r->validated();
        $d['is_preview'] = $r->boolean('is_preview');
        if ($r->hasFile('video_file')) {
            if ($old?->video_path) {
                Storage::disk('public')->delete($old->video_path);
            }$d['video_path'] = $r->file('video_file')->store('lessons/videos', 'public');
            $d['video_url'] = null;
        }if ($r->filled('video_url')) {
            if ($old?->video_path) {
                Storage::disk('public')->delete($old->video_path);
            }$d['video_path'] = null;
        }if ($r->hasFile('document_file')) {
            if ($old?->document_path) {
                Storage::disk('public')->delete($old->document_path);
            }$d['document_path'] = $r->file('document_file')->store('lessons/documents', 'public');
        }unset($d['video_file'],$d['document_file']);

        return $d;
    }

    private function deleteFiles(Lesson $l): void
    {
        Storage::disk('public')->delete(array_filter([$l->video_path, $l->document_path]));
    }
}
