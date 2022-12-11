<?php

namespace GodotEngine\I18n\Classes;

use \Gettext\Scanner\CodeScanner;
use \Gettext\Scanner\FunctionsHandlersTrait;
use \Gettext\Scanner\FunctionsScannerInterface;
use \Gettext\Translations;

/**
 * A custom markup scanner that allows us to parse special markup to extract translatable strings.
 *
 * This is the base class, which internally uses \TwigFunctionsScanner to do the actual
 * extraction from all detected functions.
 */
class TwigMarkupScanner extends CodeScanner
{
    use FunctionsHandlersTrait;

    /**
     * A list of recognized function identifiers and their mapping to gettext commands.
     */
    protected $functions = [
        'TR' => 'gettext',
    ];

    /**
     * Creates a custom function scanner.
     *
     * Part of the standard API, which we use indirectly.
     */
    public function getFunctionsScanner(): FunctionsScannerInterface
    {
        return new TwigFunctionsScanner(array_keys($this->functions));
    }

    /**
     * Hooks a custom function scanner into the AST scanner.
     */
    public function scanAST($tree, string $filename): void
    {
        $functionsScanner = $this->getFunctionsScanner();
        $functions = $functionsScanner->scanAST($tree, $filename);

        foreach ($functions as $function) {
            $this->handleFunction($function);
        }
    }

}
