<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'picture',
        'brand_id',
        'store_id',
        'stock',
        'length',
        'width',
        'height',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function shipmentItems()
    {
        return $this->hasMany(ShipmentItem::class);
    }
}
