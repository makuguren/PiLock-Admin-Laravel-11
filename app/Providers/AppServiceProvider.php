<?php

namespace App\Providers;

use Exception;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            $websiteSetting = Setting::first();
            if(!$websiteSetting){
                throw new Exception('No Settings found in the database');
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $websiteSetting = (object)[
                'website_title' => 'Pi:Lock | Admin',
                'isMaintenance' => '0',
                'isDevInteg' => '0',
                'isRegStud' => '1',
                'isRegLoginStud' => '1',
                'isRegInst' => '1',
                'isRegAdmins' => '1'
            ];
        }
        View::share('appSetting', $websiteSetting);
        Debugbar::disable();
    }
}
