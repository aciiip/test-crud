<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getPrimaries($table, $field, $start = 1, $end = 10)
    {
        $all = 'SELECT TOP ALL '.$field.' FROM '.$table.' ORDER BY '.$field;
        $limit = 'SELECT %vid, * FROM ('.$all.') AS v WHERE %vid BETWEEN '.$start.' AND '.$end;
        $transaction_ordered = DB::connection('odbc')->select($limit);
        return array_map(static function ($val) use ($field) {
            return $val[$field];
        }, $transaction_ordered);
    }
}
