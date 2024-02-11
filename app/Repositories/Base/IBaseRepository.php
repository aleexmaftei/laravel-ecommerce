<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Model;

interface IBaseRepository
{
    public function get();
    public function getById(int $id);
    public function delete(Model $model);
    public function create(array $data);
    public function update(int $id, array $data);
}
