<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Interest extends Model
{
    protected $fillable = [
        'brand_id',
        'store_id',
        'rack_id',
        'status', // 'requested', 'approved', 'rejected'
        'start_date',
        'end_date',
        'rental_rate',
        'notes'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function rack()
    {
        return $this->belongsTo(Rack::class);
    }

    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }
}
