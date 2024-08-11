<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cost',
        'order_list',
        'tracking_code',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class);
    }
}
