<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rack extends Model
{
    use HasFactory;
    protected $fillable = ['store_id', 'number', 'status'];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function rentals()
    {
        return $this->hasMany(RackRental::class);
    }
}
