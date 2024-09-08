<?php

namespace App\Repositories;

use App\Models\Product;


class ProductRepository
{
    public function find(int $id)
    {
        return Product::find($id);
    }
    public function getAllWithRelations(array $relations = [])
    {
        return Product::with($relations)->get();
    }
    public function create(array $data = [])
    {
        return Product::create($data);
    }
}
