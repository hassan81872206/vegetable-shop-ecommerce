<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'orderID';
    protected $fillable = [
        'customerID',
        'totalAmount'
    ];
}
