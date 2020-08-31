<?php namespace RainLab\Translate\Models;

use Lang;
use File;
use Cache;
use Model;
use Config;
use ApplicationException;
use ValidationException;

/**
 * Locale Model
 */
class Locale extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'rainlab_translate_locales';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'code' => 'required',
        'name' => 'required',
    ];

    public $timestamps = false;

    /**
     * @var array Object cache of self, by code.
     */
    protected static $cacheByCode = [];

    /**
     * @var array A cache of enabled locales.
     */
    protected static $cacheListEnabled;

    /**
     * @var array A cache of available locales.
     */
    protected static $cacheListAvailable;

    /**
     * @var self Default locale cache.
     */
    private static $defaultLocale;

    public function afterCreate()
    {
        if ($this->is_default) {
            $this->makeDefault();
        }
    }

    public function beforeDelete()
    {
        if ($this->is_default) {
            throw new ApplicationException(Lang::get('rainlab.translate::lang.locale.delete_default', ['locale'=>$this->name]));
        }
    }

    public function beforeUpdate()
    {
        if ($this->isDirty('is_default')) {
            $this->makeDefault();

            if (!$this->is_default) {
                throw new ValidationException(['is_default' => Lang::get('rainlab.translate::lang.locale.unset_default', ['locale'=>$this->name])]);
            }
        }
    }

    /**
     * Makes this model the default
     * @return void
     */
    public function makeDefault()
    {
        if (!$this->is_enabled) {
            throw new ValidationException(['is_enabled' => Lang::get('rainlab.translate::lang.locale.disabled_default', ['locale'=>$this->name])]);
        }

        $this->newQuery()->where('id', $this->id)->update(['is_default' => true]);
        $this->newQuery()->where('id', '<>', $this->id)->update(['is_default' => false]);
    }

    /**
     * Returns the default locale defined.
     * @return self
     */
    public static function getDefault()
    {
        if (self::$defaultLocale !== null) {
            return self::$defaultLocale;
        }

        return self::$defaultLocale = self::where('is_default', true)
            ->remember(1440, 'rainlab.translate.defaultLocale')
            ->first()
        ;
    }

    /**
     * Locate a locale table by its code, cached.
     * @param  string $code
     * @return Model
     */
    public static function findByCode($code = null)
    {
        if (!$code) {
            return null;
        }

        if (isset(self::$cacheByCode[$code])) {
            return self::$cacheByCode[$code];
        }

        return self::$cacheByCode[$code] = self::whereCode($code)->first();
    }

    /**
     * Scope for checking if model is enabled
     * @param  Builder $query
     * @return Builder
     */
    public function scopeIsEnabled($query)
    {
        return $query
            ->whereNotNull('is_enabled')
            ->where('is_enabled', true)
        ;
    }

    /**
     * Scope for ordering the locales
     * @param Builder $query
     * @return Builder
     */
    public function scopeOrder($query)
    {
        return $query
            ->orderBy('sort_order', 'asc')
        ;
    }

    /**
     * Returns true if there are at least 2 locales available.
     * @return boolean
     */
    public static function isAvailable()
    {
        return count(self::listAvailable()) > 1;
    }

    /**
     * Lists available locales, used on the back-end.
     * @return array
     */
    public static function listAvailable()
    {
        if (self::$cacheListAvailable) {
            return self::$cacheListAvailable;
        }

        return self::$cacheListAvailable = self::order()->pluck('name', 'code')->all();
    }

    /**
     * Lists the enabled locales, used on the front-end.
     * @return array
     */
    public static function listEnabled()
    {
        if (self::$cacheListEnabled) {
            return self::$cacheListEnabled;
        }

        $expiresAt = now()->addMinutes(1440);
        $isEnabled = Cache::remember('rainlab.translate.locales', $expiresAt, function() {
            return self::isEnabled()->order()->pluck('name', 'code')->all();
        });

        return self::$cacheListEnabled = $isEnabled;
    }

    /**
     * Returns true if the supplied locale is valid.
     * @return boolean
     */
    public static function isValid($locale)
    {
        $languages = array_keys(Locale::listEnabled());

        return in_array($locale, $languages);
    }

    /**
     * Clears all cache keys used by this model
     * @return void
     */
    public static function clearCache()
    {
        Cache::forget('rainlab.translate.locales');
        Cache::forget('rainlab.translate.defaultLocale');
    }
}
