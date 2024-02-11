<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    const PAYMENT_TYPE_DEBIT = 'debit';
    const PAYMENT_TYPE_CARD = 'card';

    const PAYMENTS_TYPE = [
        self::PAYMENT_TYPE_DEBIT,
        self::PAYMENT_TYPE_CARD
    ];

    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'boolean',
        'init_date' => 'date',
        'end_date' => 'date',
    ];

    // ---- Relations ---- 

    /** relation to property */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /** relation to property */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /** relation to plan */
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    /** relation to payments many to many */
    public function payments()
    {
        return $this->belongsToMany(Payment::class)->withTimestamps();
    }
}
