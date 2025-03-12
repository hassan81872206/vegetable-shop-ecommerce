<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Categorie extends Model
{
    use HasFactory , Searchable;
    
    public function toSearchableArray()
    {
        return [
            'categorieName' => $this->categorieName,
        ];
    }

    protected $primaryKey = "categorieID" ;

    protected $fillable = [
        'categorieName'
    ];

}
