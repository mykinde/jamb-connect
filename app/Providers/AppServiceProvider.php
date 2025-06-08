<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

use App\Models\User; // Import the User model

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        // Example: If you create a policy for Corrections:
        // \App\Models\Correction::class => \App\Policies\CorrectionPolicy::class,
    ];

      public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    Route::aliasMiddleware('admin', AdminMiddleware::class);
    Factory::guessFactoryNamesUsing(function (string $modelName) {
        return 'Database\\Factories\\' . class_basename($modelName) . 'Factory';
    });
    // Other route definitions...
}

    /**
     * Register any authentication / authorization services.
     */
   
}
