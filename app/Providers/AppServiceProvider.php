<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Contact;
use App\Policies\ContactPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

    protected $policies = [
        Contact::class => ContactPolicy::class,
    ];

    public function register(): void {
        //
    }

    public function boot(): void {
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        Gate::define('access-dashboard', function (User $user) {
            return $user->role === 'admin';
        });
    }
}
