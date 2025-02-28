<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RackRequest extends Model
{
    use HasFactory;
    protected $fillable = ['brand_id', 'store_id', 'requested_racks', 'status'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
