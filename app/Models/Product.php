<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Catergory::class, 'catergory_id');
    }

    public function productDetails() 
    {          
     return $this->hasMany(ProductDetail::class, 'product_id' , 'id');        
    }

    public function cartProducts()
    {
        return $this->hasMany(Cart::class);
    }
   
}
