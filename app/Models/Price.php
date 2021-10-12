<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $connection = 'odbc';
    protected $table = 'orx.Price';
    public $timestamps = false;
}
