<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailOrder extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function Barang(): BelongsTo
    {
        return $this->belongsTo('App\Models\Barang')->withDefault();
    }


    public function Order(): BelongsTo
    {
        return $this->belongsTo('App\Models\Order')->withDefault();
    }

}
