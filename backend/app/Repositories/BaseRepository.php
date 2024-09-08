<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getAllWithRelations(array $relations = [])
    {
        return $this->model->with($relations)->get();
    }

    public function create(array $data = [])
    {
        return $this->model->create($data);
    }
}
