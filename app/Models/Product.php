<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory , Searchable ;

    public function toSearchableArray()
    {
        return [
            // 'id' => $this->id,
            'productName' => $this->productName,
            // 'description' => $this->description,
        ];
    }

    protected $primaryKey = "productID" ;

    protected $fillable = [
        'productName',
        'price' ,
        'categorieID',
        'supplierID',
        'inventoryID',
        'image',
        'promotionID',
        'description'
    ];

    public function categorie(): BelongsTo{
        return $this->belongsTo(Categorie::class , "categorieID") ;
    }
    public function supplier(): BelongsTo{
        return $this->belongsTo(Supplier::class , "supplierID");
    }
    public function inventory(): BelongsTo{
        return $this->belongsTo(Inventorie::class , "inventoryID");
    }
}
