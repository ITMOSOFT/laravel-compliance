<?php

namespace ITMOSOFT\Compliance;

use Illuminate\Support\ServiceProvider;

class ComplianceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/compliance.php', 'itmosoft-compliance');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/compliance.php' => config_path('compliance.php'),
        ], 'compliance-config');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
