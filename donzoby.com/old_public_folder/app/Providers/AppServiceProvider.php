<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Profile_picture;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength (191);

        $db_images = Profile_picture::get();//get profile images saved in db
        $has_profile_pic = false;
        if (count($db_images)>0) {
            $has_profile_pic = true;
        }
        View::share('has_profile_pic', $has_profile_pic);
        View::share('profile_pic_link', $db_images);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
