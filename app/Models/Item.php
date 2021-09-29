<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $connection = 'odbc';
    protected $table = 'orx.Item';
    public $timestamps = false;
}
