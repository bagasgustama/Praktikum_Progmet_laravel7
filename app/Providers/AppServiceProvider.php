<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\View\View as ViewView;
use App\AdminNotifications;
use App\UserNotifications;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('layouts.header1', function (ViewView $view) {
            $notif = AdminNotifications::where('read_at', null)->orderBy('created_at','desc')->limit(5)->get();
            $view->with('notif',$notif);
            // dd($notif);

        });

        view()->composer('user_layouts.user_header', function (ViewView $view){
            // $notif = UserNotifications::where('read_at',null)->orderBy('created_at', 'desc')->limit(5);
            $notif = UserNotifications::where('read_at', null)->orderBy('created_at','desc')->limit(5)->get();
            $view->with('notif', $notif);
            // dd($notif);
        });
        // Schema::defaultStringLength(191);

    }
}
