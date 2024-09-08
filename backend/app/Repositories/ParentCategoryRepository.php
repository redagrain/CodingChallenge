<?php

namespace App\Repositories;

use App\Models\ParentCategory;

class ParentCategoryRepository
{
    public function getAllWithRelations(array $relations = [])
    {
        return ParentCategory::with($relations)->get();
    }

    public function create(array $data = [])
    {
        return ParentCategory::create($data);
    }
}
