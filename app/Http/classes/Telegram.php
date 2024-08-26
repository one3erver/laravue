<?php

namespace App\Http\classes;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;

class Telegram
{
    protected $telegramToken;
    protected $telegramId;

    public function __construct()
    {
        // Fetch Telegram settings from the database
        $setting = Setting::first();
        $this->telegramToken = $setting->telegram_token;
        $this->telegramId = $setting->telegram_id;
    }

    public function sendMessage($message)
    {
        $url = "https://api.telegram.org/bot%7B$this->telegramToken%7D/sendMessage";

        $response = Http::post($url, [
            'chat_id' => $this->telegramId,
            'text' => $message,
        ]);

        return $response->successful();
    }


}
