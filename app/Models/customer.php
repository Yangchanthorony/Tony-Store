<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    protected $fillable = [
        'name',
        'type',
        'country',
        'city',
        'phone',
        'date',
        'limitation_year',
        'image',
        'category_id', // Foreign key to the category table
        
    ];

    public function category()
{
    return $this->belongsTo(Category::class);
}

}
