<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uom extends Model
{
    protected $connection = 'odbc';
    protected $table = 'orx.UOM';
    public $timestamps = false;
}
