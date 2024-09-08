<?php

namespace App\Repositories;

use App\Models\ParentCategory;

class ParentCategoryRepository
{
    public function getAllWithRelations($relations = [])
    {
        return ParentCategory::with($relations)->get();
    }

    public function create($data = [])
    {
        return ParentCategory::create($data);
    }
}
