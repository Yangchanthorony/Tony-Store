<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'qty',
        'description',
        'image',
        'category_id' ,// <--- Add this
       
    ];

    public function category()
    {
        return $this->belongsTo(category::class,);
    }
    

    // public function getImageUrlAttribute()
    // {
    //     return asset('storage/' . $this->image);
    // }
}
