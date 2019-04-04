<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Service;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerServicePolicies(); 
    }

    public function registerServicePolicies(){
        Gate::define('create-service', function($user){
            if($user->hasPermission('create-service')){
                return true;
            }
            return false;
        });

        Gate::define('show-service', function($user){
            if($user->hasPermission('view-service')){
                return true;
            }
            return false;
        });

        Gate::define('update-service', function($user){
            if($user->hasPermission('update-service')){
                return true;
            }
            return false;
        });
    }
}
