<?php

namespace App\Repositories\Base;

interface IBaseRepository
{
    public function get();
    public function getById(int $id);
    public function delete(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
}
