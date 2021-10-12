<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemTransaction extends Model
{
    protected $connection = 'mysql';
    protected $table = 'item_transactions';
}
