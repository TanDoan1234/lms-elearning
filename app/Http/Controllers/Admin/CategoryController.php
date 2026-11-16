<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Category::class);
        $categories = Category::withCount('courses')->latest()->paginate(15);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        Gate::authorize('create', Category::class);

        return view('admin.categories.form', ['category' => new Category]);
    }

    public function store(CategoryRequest $r)
    {
        Gate::authorize('create', Category::class);
        $d = $r->validated();
        $d['slug'] = $this->slug($d['name']);
        Category::create($d);

        return redirect()->route('admin.categories.index')->with('success', 'Đã tạo danh mục.');
    }

    public function show(Category $category)
    {
        Gate::authorize('view', $category);

        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        Gate::authorize('update', $category);

        return view('admin.categories.form', compact('category'));
    }

    public function update(CategoryRequest $r, Category $category)
    {
        Gate::authorize('update', $category);
        $d = $r->validated();
        $d['slug'] = $this->slug($d['name'], $category->id);
        $category->update($d);

        return redirect()->route('admin.categories.index')->with('success', 'Đã cập nhật danh mục.');
    }

    public function destroy(Category $category)
    {
        Gate::authorize('delete', $category);
        if ($category->courses()->exists()) {
            return back()->with('error', 'Không thể xóa danh mục đang có khóa học.');
        }$category->delete();

        return back()->with('success', 'Đã xóa danh mục.');
    }

    private function slug(string $name, ?int $except = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $i = 2;
        while (Category::where('slug', $slug)->when($except, fn ($q) => $q->whereKeyNot($except))->exists()) {
            $slug = $base.'-'.$i++;
        }

return $slug;
    }
}
