<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    protected $primaryKey = "orderItemID" ;
    protected $fillable = [
        "price",
        "quantite",
        "orderID",
        "productID"
    ];
}
