<?php

namespace GodotEngine\I18n\Classes;

use Log;
use Cms\Classes\Page;
use Cms\Classes\Layout;
use Cms\Classes\Partial;
use \Gettext\Translations;
use GodotEngine\I18n\Classes\TwigMarkupScanner;

class TranslationExtractor
{
    /**
     * @var string The default domain name for extracted messages (used only internally).
     */
    private static $defaultDomain = 'default';

    /**
     * Normalizes the file path for the given object.
     */
    private static function makeRelativePath($object)
    {
        return $object->theme->getDirName() . '/' . $object->getObjectTypeDirName() . '/' . $object->getFileName();
    }

    /**
     * Extracts translation messages and their codes and generates PO files.
     *
     * @return array A collection of translatable messages.
     */
    public static function extractMessages()
    {
        Log::info('Starting message extraction.');

        $scanner = new TwigMarkupScanner(
            Translations::create(self::$defaultDomain)
        );
        $scanner->setDefaultDomain(self::$defaultDomain);

        Log::info('Scanning Layout files.');
        foreach (Layout::all() as $layout) {
            $tree = $layout->getTwigNodeTree();
            $scanner->scanAST($tree, self::makeRelativePath($layout));
        }

        Log::info('Scanning Page files.');
        foreach (Page::all() as $page) {
            $tree = $page->getTwigNodeTree();
            $scanner->scanAST($tree, self::makeRelativePath($page));
        }

        Log::info('Scanning Partial files.');
        foreach (Partial::all() as $partial) {
            $tree = $partial->getTwigNodeTree();
            $scanner->scanAST($tree, self::makeRelativePath($partial));
        }

        Log::info('Preparing extracted messages.');
        $translations = $scanner->getTranslations()[self::$defaultDomain];

        return $translations;
    }
}
