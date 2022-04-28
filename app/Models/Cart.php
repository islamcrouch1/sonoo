<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];


    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('stock_id', 'price', 'stock', 'vendor_price', 'product_type')
            ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
