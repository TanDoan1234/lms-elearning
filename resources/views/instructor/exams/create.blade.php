@extends('layouts.admin')
@section('content')<h1 class="mb-5 text-2xl font-bold">Tạo đề thi</h1><x-card><form method="POST" action="{{ route('instructor.courses.exams.store',$course) }}">@csrf @include('instructor.exams._form',['submitLabel'=>'Tạo đề thi'])</form></x-card>@endsection
