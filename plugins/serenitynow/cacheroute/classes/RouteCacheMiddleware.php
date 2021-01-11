<?php
namespace SerenityNow\Cacheroute\Classes;

use Illuminate\Http\Request as LaravelRequest;
use SerenityNow\Cacheroute\Models\CacheRoute;
use Closure;

class RouteCacheMiddleware
{
    public function handle(LaravelRequest $request, Closure $next)
    {
        //bail if table does not exist or
        //route not in the list of routes to be cached
        $hasTable = \Schema::hasTable('serenitynow_cacheroute_routes');
        $cacheRow = $this->shouldBeCached($request);
        $ajaxRequest = $request->ajax();

        if (!$hasTable || !$cacheRow || $ajaxRequest) {
            return $next($request);
        }

        return $this->cacheResponse($request, $next, $cacheRow['cache_ttl']);
    }

    /**
     * @param LaravelRequest $request
     * @param Closure $next
     * @param $ttl
     * @return mixed
     */
    protected function cacheResponse(LaravelRequest $request, Closure $next, $ttl)
    {
        $cacheKey = $this->getCacheKey($request->url());
        if (\Cache::has($cacheKey)) {
            return \Response::make($this->getCachedContent($cacheKey, $request, \Cache::get($cacheKey)), 200);
        }

        $response = $next($request);
        \Cache::put($cacheKey, $response->getContent(), $ttl);
        return $response;
    }

    /**
     * add instrumentation to help with debug. Adding ?debug
     * to a cached url will precede the content with "CACHED"
     *
     * @param $cacheKey
     * @param $request
     * @param $content
     * @return string
     */
    protected function getCachedContent($cacheKey, $request, $content)
    {
        $isDebugRequest = $request->exists('debug') || $request->exists('cache-info');
        if ($isDebugRequest) {
            return $content.'
            <div class="cache-notice" style="display: block; position: fixed; width: 50%; background: #fff; padding: 20px 30px 25px; left: 50%; border: 1px solid #aaa; margin-left: calc(-50% / 2); bottom: 10%; z-index: 500; box-shadow: 0 0 20px rgba(0,0,0,0.2); font-size: 16px; font-size: 1.6rem;">
                <div class="title" style="margin: -20px -30px 10px; background: #999; color: #fff; padding: 10px 30px; text-align: center;">CACHED CONTENT</div>
                <span class="cache_key" style="display: inline-block; width: 100%; background: #fff; padding: 10px 10px 10px 0; margin-bottom: -10px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    <span class="title" style="float: left; width:45px; color: #000; font-weight: bold; line-height: 30px;">URL: </span>
                    <input readonly class="value" style="float: left; width: calc(100% - 45px); border:1px solid #000; color: red; padding: 5px 7px; height: 30px; background: #eee" type="text" value="'.$request->url().'">
                </span>
                <span class="cache_key" style="display: inline-block; width: 100%; background: #fff; color: red; padding: 10px 10px 10px 0; margin-bottom: -10px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    <span class="title" style="float: left; width:45px; color: #000; font-weight: bold; line-height: 30px;">KEY: </span>
                    <input readonly class="value" style="float: left; width: calc(100% - 45px); border:1px solid #000; color: red; padding: 5px 7px; height: 30px; background: #eee" type="text" value="'.$cacheKey.'">
                </span>
                <hr style="border:none;">
                <a href="'.$request->url().'" class="cancel" style="float: left; background: #aaa; color: #fff; padding: 10px 15px; margin-top: 20px; text-decoration: none;">Cancel</a>
                <a href="?cache-clear" class="alert alert-info" style="float: right; background: #1991d1; color: #fff; padding: 10px 15px; margin-top: 20px; text-decoration: none;">Clear this now</a>
            </div>';
        }

        if ($request->exists('cache-clear')) {
            \Cache::forget($cacheKey);
            return \Redirect::to($request->url());
        }

        return $content;
    }

    //generate a cache key based on the url

    /**
     * @param $url
     * @return string
     */
    protected function getCacheKey($url)
    {
        return 'SerenityNow.Cacheroute.' . str_slug($url);
    }

    /**
     * @param $request
     * @return bool
     */
    protected function shouldBeCached($request)
    {
        $cacheRouteRows = \Cache::remember('SerenityNow.Cacheroute.AllCachedRoutes',
            \Config::get('cms.urlCacheTtl'),
            function () {
                return CacheRoute::orderBy('sort_order')->get()->toArray();                
            }
        );

        foreach ($cacheRouteRows as $cacheRow) {
            if (count($cacheRow) && $request->is($cacheRow['route_pattern'])) {
                return $cacheRow;
            }
        }
        return false;
    }
}
