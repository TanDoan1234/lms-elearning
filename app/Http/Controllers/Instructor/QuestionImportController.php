<?php

namespace App\Http\Controllers\Instructor;

use App\Exports\QuestionsExport;
use App\Exports\QuestionTemplateExport;
use App\Http\Controllers\Controller;
use App\Imports\QuestionsImport;
use App\Models\Course;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class QuestionImportController extends Controller
{
    private function own(Course $course): void
    {
        abort_unless(auth()->user()->isAdmin() || $course->instructor_id === auth()->id(), 403);
    }

    public function store(Request $request, Course $course): RedirectResponse
    {
        $this->own($course);
        Gate::authorize('create', Question::class);
        $request->validate(['file' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:5120']], ['file.required' => 'Vui lòng chọn tệp Excel.', 'file.mimes' => 'Tệp phải có định dạng xlsx, xls hoặc csv.', 'file.max' => 'Tệp không được vượt quá 5 MB.']);
        $import = new QuestionsImport($course, auth()->user());
        Excel::import($import, $request->file('file'));
        if ($import->failures()) {
            $errors = collect($import->failures())->map(fn ($failure) => 'Dòng '.$failure->row().': '.implode(' ', $failure->errors()))->all();

            return back()->with('error', 'Một số dòng không thể nhập.')->with('import_errors', $errors);
        }

        return back()->with('success', 'Nhập câu hỏi thành công.');
    }

    public function template(): BinaryFileResponse
    {
        return Excel::download(new QuestionTemplateExport, 'mau-cau-hoi.xlsx');
    }

    public function export(Course $course): BinaryFileResponse
    {
        $this->own($course);
        Gate::authorize('viewAny', Question::class);

        return Excel::download(new QuestionsExport($course), 'cau-hoi-'.$course->slug.'.xlsx');
    }
}
