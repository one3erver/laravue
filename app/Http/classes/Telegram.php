<?php

namespace App\Http\classes;

use App\Models\Setting;
use Exception;
use Illuminate\Support\Facades\Http;

class Telegram
{
    protected $telegramToken;
    protected $telegramId;
    protected $retryCount = 3; // تعداد تلاش‌ها

    public function __construct()
    {
        // Fetch Telegram settings from the database
        $setting = Setting::first();
        $this->telegramToken = $setting->telegram_token;
        $this->telegramId = $setting->telegram_id;
    }

    public function sendMessage($message)
    {
        $url = "https://api.telegram.org/bot{$this->telegramToken}/sendMessage";
        $attempts = 0;
        $successful = false;

        while ($attempts < $this->retryCount && !$successful) {
            try {
                $response = Http::get($url, [
                    'chat_id' => $this->telegramId,
                    'text' => $message,
                ]);

                if ($response->successful()) {
                    $successful = true;
                } else {
                    $attempts++;
                }
            } catch (Exception $e) {
                $attempts++;
            }
        }
        return $successful;
    }
}
