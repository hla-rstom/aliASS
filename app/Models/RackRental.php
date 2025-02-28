<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RackRental extends Model
{
    use HasFactory;
    protected $fillable = ['rack_id', 'brand_id', 'start_date', 'end_date', 'status'];

    public function rack()
    {
        return $this->belongsTo(Rack::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
