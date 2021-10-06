<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $connection = 'odbc';
    protected $table = 'orx.Order';
    public $timestamps = false;

    public function items ()
    {
        return $this->hasMany(OrderItem::class, 'OrderID', 'ID');
    }
}
