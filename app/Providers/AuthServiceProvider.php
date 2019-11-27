<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
		 \App\Models\Topic::class => \App\Policies\TopicPolicy::class,
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Set auto-authentication strategy
        Gate::guessPolicyNamesUsing(function ($modelClass) {
            // Auto return Policy according to Model used.
            // eg: 'App\Model\User' => 'App\Policies\UserPolicy'
            return 'App\Policies\\'.class_basename($modelClass).'Policy';
        });
    }
}
