<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    protected $connection = 'odbc';
    protected $table = 'orx.Instruction';
    public $timestamps = false;
}
