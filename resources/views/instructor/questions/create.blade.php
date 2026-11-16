@extends('layouts.admin')
@section('content')<h1 class="mb-5 text-2xl font-bold">Thêm câu hỏi</h1><x-card><form method="POST" action="{{ route('instructor.courses.questions.store',$course) }}">@csrf @include('instructor.questions._form',['submitLabel'=>'Lưu câu hỏi'])</form></x-card>@endsection
