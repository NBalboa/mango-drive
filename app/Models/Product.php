<?php

namespace App\Models;

use App\Enums\IsAvailable;
use App\Enums\IsDeleted;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'supplier_id',
        'quantity',
        'sold_by_quantity',
        'image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }


    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    public function scopeNotDeleted($query)
    {
        $query->where('is_deleted', '=', IsDeleted::NO->value);
    }

    public function scopeIsAvailable($query)
    {
        $query->where('is_available', '=', IsAvailable::YES->value);
    }
}
