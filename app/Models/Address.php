<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $fillable = [
        'street',
        'barangay',
        'city',
        'province',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
