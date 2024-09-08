<?php

namespace App\Repositories;

use App\Models\Product;


class ProductRepository
{
    public function getAllWithRelations( $relations = [])
    {
        return Product::with($relations)->get();
    }
    public function create( $data = [])
    {
        return Product::create($data)->categories()->sync($data['category_id']);
    }
}
