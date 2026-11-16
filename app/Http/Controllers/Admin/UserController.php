<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index(Request $r)
    {
        Gate::authorize('viewAny', User::class);
        $users = User::query()->when($r->search, fn ($q, $v) => $q->where(fn ($x) => $x->where('name', 'like', "%$v%")->orWhere('email', 'like', "%$v%")))->when($r->role, fn ($q, $v) => $q->where('role', $v))->latest()->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        Gate::authorize('create', User::class);

        return view('admin.users.form', ['user' => new User]);
    }

    public function store(UserRequest $r)
    {
        Gate::authorize('create', User::class);
        User::create($r->validated());

        return redirect()->route('admin.users.index')->with('success', 'Đã tạo người dùng.');
    }

    public function show(User $user)
    {
        Gate::authorize('view', $user);

        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        Gate::authorize('update', $user);

        return view('admin.users.form', compact('user'));
    }

    public function update(UserRequest $r, User $user)
    {
        Gate::authorize('update', $user);
        $data = $r->validated();
        if (empty($data['password'])) {
            unset($data['password']);
        }$user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Đã cập nhật người dùng.');
    }

    public function destroy(Request $r, User $user)
    {
        Gate::authorize('delete', $user);
        if ($r->user()->is($user)) {
            return back()->with('error', 'Bạn không thể xóa chính mình.');
        }$user->delete();

        return back()->with('success','Đã xóa người dùng.');
    }
}
