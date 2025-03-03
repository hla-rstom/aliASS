<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class RentalAgreement extends Model
{
    protected $fillable = [
        'interest_id',
        'status', // 'active', 'completed', 'terminated'
        'start_date',
        'end_date',
        'rental_rate',
        'payment_terms',
        'terms_conditions'
    ];

    public function interest()
    {
        return $this->belongsTo(Interest::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
