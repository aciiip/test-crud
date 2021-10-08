<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Duration extends Model
{
    protected $connection = 'odbc';
    protected $table = 'orx.Duration';
    public $timestamps = false;
}
