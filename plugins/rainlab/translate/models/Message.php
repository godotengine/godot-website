<?php namespace RainLab\Translate\Models;

use Str;
use Lang;
use Model;
use Cache;
use Config;

/**
 * Message Model
 */
class Message extends Model
{
    const DEFAULT_LOCALE = 'x';

    /**
     * @var string The database table used by the model.
     */
    public $table = 'rainlab_translate_messages';

    /**
     * @var array Guarded fields
     */
    protected $guarded = [];

    /**
     * @var array List of attribute names which are json encoded and decoded from the database.
     */
    protected $jsonable = ['message_data'];

    /**
     * @var bool Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    public static $hasNew = false;

    public static $url;

    public static $locale;

    public static $cache = [];

    /**
     * Returns the value for the active locale.
     * @return string
     */
    public function getContentAttribute()
    {
        return $this->forLocale(Lang::getLocale());
    }

    /**
     * Gets a message for a given locale, or the default.
     * @param  string $locale
     * @return string
     */
    public function forLocale($locale = null, $default = null)
    {
        if ($locale === null) {
            $locale = self::DEFAULT_LOCALE;
        }

        if (array_key_exists($locale, $this->message_data)) {
            return $this->message_data[$locale];
        }

        return $default;
    }

    /**
     * Writes a translated message to a locale.
     * @param  string $locale
     * @param  string $message
     * @return void
     */
    public function toLocale($locale = null, $message)
    {
        if ($locale === null) {
            return;
        }

        $data = $this->message_data;
        $data[$locale] = $message;

        if (!$message) {
            unset($data[$locale]);
        }

        $this->message_data = $data;
        $this->save();
    }

    /**
     * Creates or finds an untranslated message string.
     * @param  string $messageId
     * @param  string $locale
     * @return string
     */
    public static function get($messageId, $locale = null)
    {
        $locale = $locale ?: self::$locale;
        if (!$locale) {
            return $messageId;
        }

        $messageCode = self::makeMessageCode($messageId);

        /*
         * Found in cache
         */
        if (array_key_exists($locale . $messageCode, self::$cache)) {
            return self::$cache[$locale . $messageCode];
        }

        /*
         * Uncached item
         */
        $item = static::firstOrNew([
            'code' => $messageCode
        ]);

        /*
         * Create a default entry
         */
        if (!$item->exists) {
            $data = [static::DEFAULT_LOCALE => $messageId];
            $item->message_data = $item->message_data ?: $data;
            $item->save();
        }

        /*
         * Schedule new cache and go
         */
        $msg = $item->forLocale($locale, $messageId);
        self::$cache[$locale . $messageCode] = $msg;
        self::$hasNew = true;

        return $msg;
    }

    /**
     * Import an array of messages. Only known messages are imported.
     * @param  array $messages
     * @param  string $locale
     * @return void
     */
    public static function importMessages($messages, $locale = null)
    {
        self::importMessageCodes(array_combine($messages, $messages), $locale);
    }

    /**
     * Import an array of messages. Only known messages are imported.
     * @param  array $messages
     * @param  string $locale
     * @return void
     */
    public static function importMessageCodes($messages, $locale = null)
    {
        if ($locale === null) {
            $locale = static::DEFAULT_LOCALE;
        }

        foreach ($messages as $code => $message) {
            // Ignore empties
            if (!strlen(trim($message))) {
                continue;
            }

            $code = self::makeMessageCode($code);

            $item = static::firstOrNew([
                'code' => $code
            ]);

            // Do not import non-default messages that do not exist
            if (!$item->exists && $locale != static::DEFAULT_LOCALE) {
                continue;
            }

            $messageData = $item->exists || $item->message_data ? $item->message_data : [];

            // Do not overwrite existing translations
            if (isset($messageData[$locale])) {
                continue;
            }

            $messageData[$locale] = $message;

            $item->message_data = $messageData;
            $item->save();
        }
    }

    /**
     * Looks up and translates a message by its string.
     * @param  string $messageId
     * @param  array  $params
     * @param  string $locale
     * @return string
     */
    public static function trans($messageId, $params = [], $locale = null)
    {
        $msg = static::get($messageId, $locale);

        $params = array_build($params, function($key, $value){
            return [':'.$key, $value];
        });

        $msg = strtr($msg, $params);

        return $msg;
    }

    /**
     * Set the caching context, the page url.
     * @param string $locale
     * @param string $url
     */
    public static function setContext($locale, $url = null)
    {
        if (!strlen($url)) {
            $url = '/';
        }

        self::$url = $url;
        self::$locale = $locale;

        if ($cached = Cache::get(self::makeCacheKey())) {
            self::$cache = (array) $cached;
        }
    }

    /**
     * Save context messages to cache.
     * @return void
     */
    public static function saveToCache()
    {
        if (!self::$hasNew || !self::$url || !self::$locale) {
            return;
        }

        $expiresAt = now()->addMinutes(Config::get('rainlab.translate::cacheTimeout', 1440));
        Cache::put(self::makeCacheKey(), self::$cache, $expiresAt);
    }

    /**
     * Creates a cache key for storing context messages.
     * @return string
     */
    protected static function makeCacheKey()
    {
        return 'translation.'.self::$locale.self::$url;
    }

    /**
     * Creates a sterile key for a message.
     * @param  string $messageId
     * @return string
     */
    protected static function makeMessageCode($messageId)
    {
        $separator = '.';

        // Convert all dashes/underscores into separator
        $messageId = preg_replace('!['.preg_quote('_').'|'.preg_quote('-').']+!u', $separator, $messageId);

        // Remove all characters that are not the separator, letters, numbers, or whitespace.
        $messageId = preg_replace('![^'.preg_quote($separator).'\pL\pN\s]+!u', '', mb_strtolower($messageId));

        // Replace all separator characters and whitespace by a single separator
        $messageId = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $messageId);

        return Str::limit(trim($messageId, $separator), 250);
    }
}
