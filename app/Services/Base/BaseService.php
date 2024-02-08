<?php

namespace App\Services\Base;

use Exception;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class BaseService
{
    public function execute_in_transaction($func)
    {
        if (!is_callable($func)) {
            throw new RuntimeException("Parameter should be a function!");
        }

        $result = null;
        try {
            DB::beginTransaction();
            $result = $func();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            report($exception);
        }

        return $result;
    }
}
