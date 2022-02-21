<?php

namespace App\Providers;

use App\User;
use App\Permissions;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
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

        // Gate::define('isAllowedToThis', function($user, $permission = '') {
        //     foreach ($user->roles as $key => $value) {
        //         return $value->rolepermissions->contains($permission);
        //     }
        // });

        foreach (Permissions::all() as $permission) {
            Gate::define($permission->title, function (User $user) use ($permission){
        
               $action = $permission->title;
               return $user->roles->contains($permission->id);
                // do your check, can $user do $action with $thing
        
            });
        }
        
        
    }
}
