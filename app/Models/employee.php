<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    protected $fillable = [
        'section',
        'qty',
    ];
    public function staff()
    {
         return $this->belongsTo(Staff::class, 'section_id'); // replace 'staff_id' with your actual column name
    }
}
