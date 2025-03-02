<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ShipmentItem extends Model
{
    protected $fillable = [
        'shipment_id',
        'product_id',
        'quantity',
        'condition_sent', // Condition when sent
        'condition_received', // Condition when received
        'notes'
    ];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
