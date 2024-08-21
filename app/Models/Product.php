<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'caption',
        'image',
        'image_thumbnail',
        'price',
        'stock',
        'status'
    ];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

}
