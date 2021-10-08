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

    public function instruction ()
    {
        return $this->belongsTo(Instruction::class, 'InstructionID', 'ID');
    }

    public function frequency ()
    {
        return $this->belongsTo(Frequency::class, 'FrequencyID', 'ID');
    }

    public function duration ()
    {
        return $this->belongsTo(Duration::class, 'DurationID', 'ID');
    }
}
