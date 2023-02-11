<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catergory extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function products()
    {
        return $this->hasMany(Product::class, 'catergory_id' , 'id');
    }

    public function brands()
    {
        return $this->hasMany(Catergory::class, 'catergory_id');
    }

   
}
