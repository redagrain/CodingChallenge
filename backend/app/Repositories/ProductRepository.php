<?php

namespace App\Repositories;

use App\Models\Product;

use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository
{

    public function __construct()
    {
        parent::__construct(new Product);
    }

    public function create(array $data = [])
    {
        return parent::create($data)->categories()->sync($data['category_id']);
    }
}
