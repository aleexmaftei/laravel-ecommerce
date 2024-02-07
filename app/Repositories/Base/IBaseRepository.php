<?php

namespace App\Repositories\Base;

interface IBaseRepository
{
    public function get();
    public function getById($id);
    public function delete($id);
    public function create(array $data);
    public function update($id, array $data);
}
