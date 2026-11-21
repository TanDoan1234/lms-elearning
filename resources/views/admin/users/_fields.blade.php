{{-- Shared user form fields. $user is the model being edited (or a new User); $prefix keeps element ids unique when the form is rendered inside a modal on a page that has other inputs with the same names. --}}
@php($prefix = $prefix ?? '')
<x-input name="name" id="{{ $prefix }}name" label="Họ tên" :value="$user->name" autocomplete="name"/>
<x-input name="email" id="{{ $prefix }}email" type="email" label="Email" :value="$user->email" autocomplete="off"/>
<x-select name="role" id="{{ $prefix }}role" label="Vai trò">@foreach(['admin'=>'Admin','instructor'=>'Giảng viên','student'=>'Học viên'] as $v=>$l)<option value="{{ $v }}" @selected(old('role',$user->role ?? 'student')===$v)>{{ $l }}</option>@endforeach</x-select>
<x-input name="password" id="{{ $prefix }}password" type="password" label="Mật khẩu" autocomplete="new-password" :help="$user->exists ? 'Để trống nếu không đổi mật khẩu.' : 'Tối thiểu 8 ký tự.'"/>
<x-input name="password_confirmation" id="{{ $prefix }}password_confirmation" type="password" label="Xác nhận mật khẩu" autocomplete="new-password"/>
