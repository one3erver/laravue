<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'telegram_id',
        'telegram_token',
        'wallets',
        'header',
        'logo',
        'site_title',
    ];
}
