<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTransaction extends Model
{
    protected $connection = 'odbc';
    protected $table = 'orx.UserTransaction';
    public $timestamps = false;

    public function patient ()
    {
        return $this->belongsTo(Patient::class, 'PatientID', 'ID');
    }

    public function invoice ()
    {
        return $this->hasOne(Invoice::class, 'TransactionID', 'ID');
    }

    public function company ()
    {
        return $this->belongsTo(Company::class, 'CompanyID', 'ID');
    }

    public function order ()
    {
        return $this->hasOne(Order::class, 'TransactionID', 'ID');
    }
}
