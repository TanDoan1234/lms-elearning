<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Services\CertificateService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CertificateController extends Controller
{
    public function index(CertificateService $service): View
    {
        $user = auth()->user();
        $user->enrolledCourses()->wherePivot('status', 'active')->get()->each(fn ($course) => $service->issueIfEligible($user, $course));
        $certificates = $user->certificates()->with('course.instructor')->latest('issued_at')->paginate(12);

        return view('certificates.index', compact('certificates'));
    }

    public function download(Certificate $certificate): StreamedResponse
    {
        Gate::authorize('view', $certificate);
        abort_unless($certificate->file_path && Storage::disk('public')->exists($certificate->file_path), 404);

        // ?inline=1: mở PDF ngay trên trình duyệt (nút "Xem chứng chỉ"), mặc định tải về.
        $disposition = request()->boolean('inline') ? 'inline' : 'attachment';

        return Storage::disk('public')->response($certificate->file_path, $certificate->code.'.pdf', [], $disposition);
    }

    public function verify(string $code): View
    {
        $certificate = Certificate::with(['user', 'course.instructor'])->where('code', $code)->first();

        return view('certificates.verify', compact('certificate', 'code'));
    }
}
