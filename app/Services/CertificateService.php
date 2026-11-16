<?php

namespace App\Services;

use App\Models\Certificate;
use App\Models\Course;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CertificateService
{
    public function issueIfEligible(User $user, Course $course): ?Certificate
    {
        if (! $this->completed($user, $course)) {
            return null;
        }

        $finalExam = $course->finalExam()->first();
        if ($finalExam && ! $finalExam->attempts()->where('user_id', $user->id)->where('passed', true)->exists()) {
            return null;
        }

        $certificate = Certificate::firstOrCreate(
            ['user_id' => $user->id, 'course_id' => $course->id],
            ['code' => $this->uniqueCode(), 'issued_at' => now()]
        );

        if (! $certificate->file_path || ! Storage::disk('public')->exists($certificate->file_path)) {
            $certificate->load(['user', 'course.instructor']);
            $path = 'certificates/'.$certificate->code.'.pdf';
            Storage::disk('public')->put($path, Pdf::loadView('pdf.certificate', ['certificate' => $certificate])
                ->setPaper('a4', 'landscape')->output());
            $certificate->update(['file_path' => $path]);
        }

        return $certificate->fresh();
    }

    private function completed(User $user, Course $course): bool
    {
        if (class_exists(ProgressService::class) && method_exists(ProgressService::class, 'isCourseCompleted')) {
            return app(ProgressService::class)->isCourseCompleted($user, $course);
        }

        $total = $course->lessons()->count();
        $completed = $user->completedLessons()->whereHas('section', fn ($query) => $query->where('course_id', $course->id))->count();

        return $total === 0 || $completed >= $total;
    }

    private function uniqueCode(): string
    {
        do {
            $code = 'LMS-'.now()->year.'-'.Str::upper(Str::random(8));
        } while (Certificate::where('code', $code)->exists());

        return $code;
    }
}
