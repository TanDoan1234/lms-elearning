@extends('layouts.admin')
@section('content')<h1 class="mb-5 text-2xl font-bold">Sửa đề thi</h1><x-card><form method="POST" action="{{ route('instructor.courses.exams.update',[$course,$exam]) }}">@csrf @method('PUT') @include('instructor.exams._form',['submitLabel'=>'Cập nhật đề thi'])</form></x-card>@endsection
