<?php

namespace App\Providers;

use App\View\Components\Common\Breadcrumb;
use App\View\Components\Common\Navigation;
use App\View\Components\Common\PageLoader;
use App\View\Components\Master\Footer;
use App\View\Components\Master\HeaderAndSidebar;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Backend Component
         */
        Blade::component('backend-header-and-sidebar', HeaderAndSidebar::class); // Header & SideBar
        Blade::component('backend-footer', Footer::class); // Footer
        Blade::component('backend-page-loader', PageLoader::class); // Breadcrumb
        Blade::component('backend-breadcrumb', Breadcrumb::class); // Breadcrumb
        Blade::component('backend-navigation', Navigation::class); // Backend-Navigation
    }
}
