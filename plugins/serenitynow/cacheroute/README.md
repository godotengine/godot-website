##CacheRoute plugin

As we are well aware, the best way to speed up a web application is to serve cached content. This is especially true for 
an interpreted language like PHP.The logic is simple - if there is no server-side processing to render a page, response is almost immediate.
The CacheRoute plugin for OctoberCMS is designed to provide a speedup to relatively static pages by caching entire routes. 

So, Let's say you indicate in the backend that you want to have "`blog/*`" cached. The first time you invoke a url matching this pattern,
 (i.e. cache miss) it goes through all the motions of querying the database, rendering the template and displaying the output.
This entire page content is then cached (in whatever store you specify in your `config->cache` file).

The next time the same url is requested (while the number of minutes specified in the TTL does not elapse), 
the cached content is served. So, no database calls, no php rendering overhead, no twig rendering overhead etc. 
This results in substantial page speedup.

###How it works
Routes (or route patterns) that you want cached are entered in the backend section (CacheRoutes).
On boot, the CacheRoute plugin registers a global middleware that intercepts all requests. This middleware then 
uses "before" and "after" criteria to cache entire pages that match pattern(s) specified in the table. 

###Main features
* The contents of the backend cacheroute table are cached to avoid the overhead of a database query on every route - The ttl for
    this cache is extracted from `config->cms->urlCacheTtl` (i.e. `Config::get(cms.urlCacheTtl)`)
* You can specify different TTL (time to live) values for different routes
* The plugin uses a simple `Request::is('pattern')` to check for a match (and cache the corresponding route)

###Installation
1. Go to __Settings > "Updates & Plugins"__ page in the Backend.
2. Click on the __"Install plugins"__ option.
3. Type __CacheRoute__ text in the search field, and pick the appropriate plugin.
4. On your backend, under the "CacheRoute" menu, enter your route pattern(s) and corresponding cache ttl and sort order.
5. Example:

| Route Pattern   |      TTL      |  Sort Order |
|-----------------|---------------|-------------|
| resume 		  |  100		  | 1		    |
| blog			  |  10			  | 2			|
| blog/*		  |  10			  | 3			|

###Usage Notes and other information
* Be mindful of what you are caching! This approach works best for relatively static global content.
* Note that __it is required to clear ALL cached content every time you add a new route pattern for the plugin to work with it__. To do this, you can use the provided button in the plugin backend panel (or "`php artisan cache:clear`" on terminal). This will clear __ALL__ the cached content, both by the plugin and the backend, if any.
* You can verify functionality by appending "`?cache-info`" (or "`?debug`" as in previous versions of this plugin) to a cached url, e.g.: `http://mysite.com/mypage?cache-info`.
    This would show a modal window (centered in the lower part of the screen) over your page content reflecting this specific cache related information, as well as a button to clear (__only__) this specific content cache.
* You can also clear any specific page cached content directly appending "`?cache-clear`" to its url, e.g.: `http://mysite.com/mypage?cache-clear`
* FYI: the cache key is a slug of the request url (without any get params) i.e. str_slug($request->url())
