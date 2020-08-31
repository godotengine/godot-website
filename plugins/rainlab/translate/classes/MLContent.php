<?php namespace RainLab\Translate\Classes;

/**
 * Represents a multi-lingual Static Content object.
 *
 * @package rainlab\translate
 * @author Alexey Bobkov, Samuel Georges
 */
class MLContent extends MLCmsObject
{
    public static function findLocale($locale, $page)
    {
        if (!$page->exists) {
            return null;
        }

        $fileName = $page->getOriginal('fileName');

        $fileName = static::addLocaleToFileName($fileName, $locale);

        return static::forLocale($locale, $page)->find($fileName);
    }

    /**
     * Returns the directory name corresponding to the object type.
     * Content does not use localized sub directories, but as file suffix instead.
     * @return string
     */
    public function getObjectTypeDirName()
    {
        return static::$parent->getObjectTypeDirName();
    }

    /**
     * Splice in the locale when setting the file name.
     * @param mixed $value
     */
    public function setFileNameAttribute($value)
    {
        $value = static::addLocaleToFileName($value, static::$locale);

        parent::setFileNameAttribute($value);
    }

    /**
     * Splice the active locale in to the filename
     * - content.htm -> content.en.htm
     */
    protected static function addLocaleToFileName($fileName, $locale)
    {
        /*
         * Check locale not already present
         */
        $parts = explode('.', $fileName);
        array_shift($parts);

        foreach ($parts as $part) {
            if (trim($part) === $locale) {
                return $fileName;
            }
        }

        return substr_replace($fileName, '.'.$locale, strrpos($fileName, '.'), 0);
    }
}
