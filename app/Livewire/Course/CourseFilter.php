<?php

namespace App\Livewire\Course;

use App\Models\Category;
use App\Models\Course;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class CourseFilter extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';

    #[Url]
    public string $category = '';

    #[Url]
    public string $price = '';

    #[Url]
    public string $level = '';

    #[Url]
    public string $sort = 'newest';

    public function updated($property): void
    {
        if ($property !== 'page') {
            $this->resetPage();
        }
    }

    public function render()
    {
        $query = Course::published()->with(['category', 'instructor'])->withCount('students')
            ->when($this->search, fn ($q) => $q->where('title', 'like', '%'.$this->search.'%'))
            ->when($this->category, fn ($q) => $q->where('category_id', $this->category))
            ->when($this->price === 'free', fn ($q) => $q->free())
            ->when($this->price === 'paid', fn ($q) => $q->paid())
            ->when($this->level, fn ($q) => $q->where('level', $this->level));
        match ($this->sort) {
            'popular' => $query->orderByDesc('students_count'),
            'price_asc' => $query->orderBy('price'),
            'price_desc' => $query->orderByDesc('price'),
            default => $query->latest(),
        };

        return view('livewire.course.course-filter', ['courses' => $query->paginate(9), 'categories' => Category::orderBy('name')->get()]);
    }
}
