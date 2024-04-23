<?php

namespace App\Providers;

use App\Services\Verification\Contracts\VerificationServiceContract;
use App\Services\Verification\VerificationCacheService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    public $singletons = [
        VerificationServiceContract::class => VerificationCacheService::class
    ];

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
        //
    }
}
