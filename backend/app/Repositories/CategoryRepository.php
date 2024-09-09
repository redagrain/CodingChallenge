<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function getAll()
    {
        return Category::all();
    }
    public function getSubcategories()
    {
        return Category::whereNotNull('parent_id')->get();
    }
    public function create(array $data = [])
    {
        return Category::create($data);
    }
}
