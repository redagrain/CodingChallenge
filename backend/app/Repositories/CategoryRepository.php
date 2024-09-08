<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function create($data = [])
    {
        return Category::create($data);
    }
}
