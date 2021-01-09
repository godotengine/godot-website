<?php namespace SerenityNow\Cacheroute;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function boot()
    {
        //add RouteCacheMiddleware as a global middleware to intercept all routes
        $this->app['Illuminate\Contracts\Http\Kernel']
             ->pushMiddleware('SerenityNow\CacheRoute\Classes\RouteCacheMiddleware');
    }
    
}
