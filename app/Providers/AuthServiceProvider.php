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

        Gate::define('manage-users',function($user){
            if($user->level == "admin"){
                return TRUE;
            }
        });

        Gate::define('manage-categories',function($user){
            if($user->level == "admin"){
                return TRUE;
            }
        });

        Gate::define('manage-sliders',function($user){
            if($user->level == "admin"){
                return TRUE;
            }
        });

        Gate::define('manage-customers',function($user){
            if($user->level == "admin"){
                return TRUE;
            }
        });

        Gate::define('manage-products',function($user){
            if($user->level == "seller"){
                return TRUE;
            }
        });

        Gate::define('manage-pesanan-masuk',function($user){
            if($user->level == "seller"){
                return TRUE;
            }
        });

        Gate::define('manage-pesanan-dikirim',function($user){
            if($user->level == "seller"){
                return TRUE;
            }
        });

        Gate::define('manage-pesanan-diterima',function($user){
            if($user->level == "seller"){
                return TRUE;
            }
        });

        Gate::define('manage-rekening',function($user){
            if($user->level == "seller"){
                return TRUE;
            }
        });

        Gate::define('manage-ongkir',function($user){
            if($user->level == "seller"){
                return TRUE;
            }
        });

        Gate::define('manage-penghasilan',function($user){
            if($user->level == "seller"){
                return TRUE;
            }
        });

        Gate::define('manage-laporan-penjualan',function($user){
            if($user->level == "seller"){
                return TRUE;
            }
        });
        
    }
}
