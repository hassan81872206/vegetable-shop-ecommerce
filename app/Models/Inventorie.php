<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventorie extends Model
{
    use HasFactory;
    protected $primaryKey = "inventoryID" ;
     
    protected $fillable = [
        'quantite'
    ];
}
