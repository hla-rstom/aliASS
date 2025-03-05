<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    use HasFactory;
    protected $fillable = [
        'name',
        'logo',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function rentals()
    {
        return $this->hasMany(RackRental::class);
    }
    public function requests()
    {
        return $this->hasMany(RackRequest::class);
    }

    //  brand_owner
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
