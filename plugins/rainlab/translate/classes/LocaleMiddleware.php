<?php namespace RainLab\Translate\Classes;

use RainLab\Translate\Classes\Translator;
use Closure;
use Config;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $translator = Translator::instance();
        $translator->isConfigured();

        if (!$translator->loadLocaleFromRequest()) {
            if (Config::get('rainlab.translate::prefixDefaultLocale')) {
                $translator->loadLocaleFromSession();
            } else {
                $translator->setLocale($translator->getDefaultLocale());
            }
        }

        return $next($request);
    }
}
