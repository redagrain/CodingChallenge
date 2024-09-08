<?php

namespace App\Repositories;

use App\Models\ParentCategory;
use App\Repositories\BaseRepository;

class ParentCategoryRepository extends BaseRepository
{

    public function __construct()
    {
        parent::__construct(new ParentCategory);
    }
}
