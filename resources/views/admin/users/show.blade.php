@extends('layouts.admin') @section('content')<x-card title="Thông tin người dùng"><p>{{ $user->name }}</p><p>{{ $user->email }}</p><p>{{ $user->role }}</p></x-card>@endsection
