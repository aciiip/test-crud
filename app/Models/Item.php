<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $connection = 'odbc';
    protected $table = 'orx.Item';
    public $timestamps = false;

    public function uom ()
    {
        return $this->belongsTo(Uom::class, 'UOMID', 'ID');
    }

    public function purchase_uom ()
    {
        return $this->belongsTo(Uom::class, 'PurchUOMID', 'ID');
    }

    public function price ()
    {
        return $this->hasOne(Price::class, 'ItemID', 'ID');
    }
}
