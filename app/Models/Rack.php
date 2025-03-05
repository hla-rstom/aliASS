<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Store;

class Rack extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'store_id',
        'name',
        'volume',
        'length',
        'width',
        'capacity',
        'photo',
        'price_per_day',
        'price_per_week',
        'price_per_month'
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    // request for racks
    public function interests()
    {
        return $this->hasMany(Interest::class);
    }
}
