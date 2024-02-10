<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    const GENERATE = 'generado';
    const SEND_TO_PAY = 'enviado_a_pagar';
    const PAID = 'pagado';

    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'init_date' => 'date',
        'end_date' => 'date',
        'period_start' => 'date',
        'period_end' => 'date',
        'generate_date' => 'date',
        'send_to_pay_date' => 'date',
        'paid_date' => 'date',
    ];
}
