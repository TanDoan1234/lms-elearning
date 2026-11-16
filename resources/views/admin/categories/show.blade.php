@extends('layouts.admin') @section('content')<x-card :title="$category->name"><p>{{ $category->description }}</p></x-card>@endsection
