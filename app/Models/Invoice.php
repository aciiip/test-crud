<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $connection = 'odbc';
    protected $table = 'orx.Invoice';
    public $timestamps = false;
}
