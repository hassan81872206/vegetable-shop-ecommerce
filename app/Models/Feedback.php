<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $primaryKey = "feedbackID" ;
    protected $fillable = [
        'comment' ,
        'customerID' ,
        'productID'
    ];

    public function customer(){
        return $this->belongsTo(User::class , "customerID");
    }
}
