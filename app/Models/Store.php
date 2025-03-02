<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{


    protected $guarded = ['id'];

    // protected $casts = [
    //     'address' => 'array',
    // ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    // public function address()
    // {
    //    return $this->hasOne(Address::class, 'store_id');
    // }

    public function racks()
    {
        return $this->hasMany(Rack::class, 'store_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($store) {
            if (!$store->user_id) {
                $store->user_id = \Auth::id();
            }
        });
    }
}
