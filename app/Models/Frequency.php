<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Frequency extends Model
{
    protected $connection = 'odbc';
    protected $table = 'orx.Frequency';
    public $timestamps = false;
}
