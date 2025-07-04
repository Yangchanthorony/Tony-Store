<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class staff extends Model
{
    protected $fillable = [
        'name',
        // 'position',
        'gender',
        'email',
        'phone',
        'date_of_birth',
        'address',
        'image',
        'section_id', // Foreign key to the section table
    ];

    public function section()
    {
        return $this->belongsTo(employee::class, 'section_id');
    }

}
