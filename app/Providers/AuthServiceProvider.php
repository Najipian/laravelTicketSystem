<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

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

        Passport::routes();

        Gate::define('show-ticket', function ($user, $ticket , $loginType) {
            if($loginType == TENANT_USER)
                return $user->id == $ticket->user_id;
            else{
                return ($user->landlord->id == $ticket->property->landlord_id) || ( $user->landlord->id == $ticket->assigned_landlord_id ) ;
            }
        });
    }
}