<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'rental_agreement_id',
        'amount',
        'status', // 'pending', 'completed', 'failed', 'refunded'
        'payment_date',
        'payment_method',
        'transaction_id'
    ];

    public function rentalAgreement()
    {
        return $this->belongsTo(RentalAgreement::class);
    }
}
