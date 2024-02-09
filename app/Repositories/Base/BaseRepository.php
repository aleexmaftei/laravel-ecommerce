<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements IBaseRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function get() : Collection
    {
        return $this->model::all();
    }

    public function getById(int $id): Model | null
    {
        return $this->model->query()->find($id);
    }

    public function delete(int $id): ?bool
    {
        return $this->model->delete();
    }

    public function create(array $data)
    {
        return $this->model->query()->create($data)->fresh();
    }

    public function update(int $id, array $data): bool|int|null
    {
        return $this->model->query()->find($id)?->update($data);
    }
}
