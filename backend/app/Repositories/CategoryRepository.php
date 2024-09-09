<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Collection;

class CategoryRepository
{
    public function getAll(): Collection
    {
        return Category::all();
    }
    public function getSubcategories(): Collection
    {
        return Category::whereNotNull('parent_id')->get();
    }
    public function create(array $data = []): Category
    {
        return Category::create($data);
    }
}
