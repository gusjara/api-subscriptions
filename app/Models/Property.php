<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $guarded = [];

    // ---- Relations ---- 

    /** relation to clients */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
