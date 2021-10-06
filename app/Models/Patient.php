<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $connection = 'odbc';
    protected $table = 'orx.Patient';
    public $timestamps = false;
}
