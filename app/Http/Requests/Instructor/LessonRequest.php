<?php

namespace App\Http\Requests\Instructor;

use App\Rules\YoutubeUrl;
use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $lesson = $this->route('lesson');
        $needsVideo = ! $lesson?->video_path && ! $lesson?->video_url;
        $needsDocument = ! $lesson?->document_path;

        return ['title' => 'required|string|max:255', 'type' => 'required|in:video,document', 'video_url' => array_filter(['nullable', $needsVideo ? 'required_without:video_file' : null, new YoutubeUrl]), 'video_file' => array_filter(['nullable', $needsVideo ? 'required_without:video_url' : null, 'file', 'mimes:mp4,webm', 'max:51200']), 'document_file' => array_filter(['nullable', $needsDocument ? 'required_if:type,document' : null, 'file', 'mimes:pdf,doc,docx,ppt,pptx', 'max:20480']), 'content' => 'nullable|string', 'duration_minutes' => 'nullable|integer|min:0', 'position' => 'nullable|integer|min:1', 'is_preview' => 'nullable|boolean'];
    }

    public function messages(): array
    {
        return ['required' => ':attribute là bắt buộc.', 'required_without' => 'Cần cung cấp :attribute.', 'required_if' => 'Cần cung cấp :attribute cho bài tài liệu.', 'video_file.mimes' => 'Video phải là MP4 hoặc WebM.', 'video_file.max' => 'Video tối đa 50 MB.', 'document_file.mimes' => 'Tài liệu phải là PDF, Word hoặc PowerPoint.', 'document_file.max' => 'Tài liệu tối đa 20 MB.'];
    }

    public function attributes(): array
    {
        return ['title' => 'Tiêu đề', 'type' => 'Loại bài học', 'video_url' => 'URL YouTube', 'video_file' => 'tệp video', 'document_file' => 'tệp tài liệu'];
    }
}
