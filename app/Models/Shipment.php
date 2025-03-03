<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = [
        'interest_id',
        'direction', // 'inbound' (brand to store), 'outbound' (store to brand)
        'status', // 'pending', 'in_transit', 'delivered', 'validated', 'completed'
        'tracking_number',
        'shipped_at',
        'received_at',
        'notes'
    ];

    public function interest()
    {
        return $this->belongsTo(Interest::class);
    }

    public function shipmentItems()
    {
        return $this->hasMany(ShipmentItem::class);
    }
}
