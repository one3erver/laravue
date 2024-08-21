<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Seeting\StoreSettingRequest;
use App\Http\Requests\Admin\Seeting\UpdateSettingRequest;
use App\Models\Setting;
use Database\Seeders\SettingSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::first();
        if ($setting === null) {
            $default = new SettingSeeder();
            $default->run();
            $setting = Setting::first();
        }
        return view('admin.settings.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSettingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        if ($request->hasFile('logo')) {
            deleteImage('/admin/settings/' . $setting->logo);
        }
        $logo = uploadImage($request->logo, 'settings', 256, 256);

        $setting->update([
            'telegram_id' => $request->telegram_id,
            'telegram_token' => $request->telegram_token,
            'landing_content' => $request->landing_content,
            'logo' => ($request->logo ? $logo : $setting->logo),
            'site_title' => $request->site_title,
        ]);

        // Save wallets to a config file if provided in the request
        if ($request->has('wallets')) {
            // Split the wallets string by newline and trim each entry to remove any extra spaces
            $wallets = array_filter(array_map('trim', explode("\n", $request->input('wallets')[0])));

            // Create an associative array with integer keys starting from 1
            $walletsArray = [];
            foreach ($wallets as $index => $wallet) {
                $walletsArray[$index + 1] = $wallet;
            }

            // Export the array as a PHP code string
            $content = var_export($walletsArray, true);

            // Replace array() with []
            $content = str_replace(['array (', ')'], ['[', ']'], $content);

            // Add the opening PHP tag and return statement
            $content = "<?php\n\nreturn " . $content . ";\n";

            // Save the wallets array to a config file (config/wallets.php)
            File::put(config_path('wallets.php'), $content);
        }

        return redirect()->route('admin.settings.index')->with('success', 'Setting updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
