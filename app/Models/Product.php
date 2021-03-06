<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
      
    protected $fillable = [
        'name',
        'price',
        'category',
        'description',
        'image'
    ];

      //Relationship
      public function user(){
        return $this->belongsTo(User::class);
    }
    //RElationship
    public function products(){
        return $this->belongsTo(User::class);
    }

  
}
