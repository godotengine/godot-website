<?php

namespace GodotEngine\Utility\Classes;

use \Gettext\Scanner\CodeScanner;
use \Gettext\Scanner\FunctionsHandlersTrait;
use \Gettext\Scanner\FunctionsScannerInterface;
use \Gettext\Translations;

/**
 * Class to scan PHP files and get gettext translations
 */
class TwigMarkupScanner extends CodeScanner
{
    use FunctionsHandlersTrait;

    protected $functions = [
        'TR' => 'gettext',
    ];

    public function getFunctionsScanner(): FunctionsScannerInterface
    {
        return new TwigFunctionsScanner(array_keys($this->functions));
    }

    public function scanAST($tree, string $filename): void
    {
        $functionsScanner = $this->getFunctionsScanner();
        $functions = $functionsScanner->scanAST($tree, $filename);

        foreach ($functions as $function) {
            $this->handleFunction($function);
        }
    }

}
