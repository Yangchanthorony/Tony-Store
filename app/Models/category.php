<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = [
        'category_name',
        'order'
    ];

    public function products()
    {
        return $this->hasMany(product::class);
    }
    public function customers()
{
    return $this->hasMany(Customer::class);
}


}
