<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $connection = 'odbc';
    protected $table = 'orx.OrderItem';
    public $timestamps = false;

    public function item ()
    {
        return $this->belongsTo(Item::class, 'ItemID', 'ID');
    }
}
