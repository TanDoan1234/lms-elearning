@extends('layouts.admin')
@section('content')<h1 class="mb-5 text-2xl font-bold">Sửa câu hỏi</h1><x-card><form method="POST" action="{{ route('instructor.courses.questions.update',[$course,$question]) }}">@csrf @method('PUT') @include('instructor.questions._form',['submitLabel'=>'Cập nhật'])</form></x-card>@endsection
