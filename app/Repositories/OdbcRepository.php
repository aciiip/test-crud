<?php
namespace App\Repositories;

use App\Models\UserTransaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OdbcRepository
{
    private $primary = 'ID';
    private $query;
    private $model;
    private $parentQuery;

    public function model($model)
    {
        $this->model = new $model();
        $this->query = 'SELECT TOP ALL ' . $this->primary . ' FROM ' . $this->model->getTable();
        return $this;
    }

    public function where($field, $value, $operator = '=')
    {
        if (strpos($this->query, 'WHERE')) {
            $this->query .= ' AND ' . $field . ' ' . $operator . ' \'' . $value . "'";
        } else {
            $this->query .= ' WHERE ' . $field . ' ' . $operator . ' \'' . $value . "'";
        }
        return $this;
    }

    public function orderBy($field, $direction = 'ASC')
    {
        $this->query .= ' ORDER BY ' . $field . ' ' . $direction;
        return $this;
    }

    public function limit($start, $end)
    {
        $this->parentQuery = 'SELECT %vid, * FROM ('.$this->query.') AS v WHERE %vid BETWEEN '.$start.' AND '.$end;
        return $this;
    }

    public function build(): Builder
    {
        $connection = $this->model->getConnection()->getConfig()['driver'];
        $query = $this->query;
        if ($this->parentQuery) {
            $query = $this->parentQuery;
        }
        $transaction_ordered = DB::connection($connection)->select($query);
        $transaction_ids = array_map(static function ($val) {
            return $val['ID'];
        }, $transaction_ordered);

        return $this->model::whereIn('ID', $transaction_ids);
    }

}