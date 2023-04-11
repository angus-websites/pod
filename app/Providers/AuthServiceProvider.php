<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use JustSteveKing\Laravel\FeatureFlags\Models\Feature;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Can this user access feedback?
        Gate::define('access-feedback', function (User $user) {
            if (Feature::where("name", "=", "feedback")->where("active", "=", 1)->exists()){
                return $user->hasFeature('feedback') || $user->isAdmin();
            }
            return 0;

        });

        // Can thie user access CV builder?
        Gate::define('access-cv', function (User $user) {

            if (Feature::where("name", "=", "CV Builder")->where("active", "=", 1)->exists()){
                return $user->hasFeature('CV Builder') || $user->isAdmin();
            }
            return 0;
        });
    }
}
