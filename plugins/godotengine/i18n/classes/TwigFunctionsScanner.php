<?php

namespace GodotEngine\I18n\Classes;

use Twig\Node\Expression\FunctionExpression;
use \Gettext\Scanner\FunctionsScannerInterface;
use \Gettext\Scanner\ParsedFunction;

/**
 * A custom function scanner that extracts translatable messages from recognized functions
 * inside of the provided markup.
 */
class TwigFunctionsScanner implements FunctionsScannerInterface
{
    /**
     * A list of recognized function identifiers.
     */
    protected $functions;

    public function __construct(array $functions = null)
    {
        $this->functions = $functions;
    }

    /**
     * Extracts data from recognized functions in the provided text.
     *
     * This is a standard method that gets called, but we don't need it.
     */
    public function scan(string $code, string $filename): array
    {
        // This function is a dud, we don't use it because we work with available ASTs directly.
        // See scanAST for the actual implementation.
        return [];
    }

    /**
     * Extracts data from recognized functions using AST.
     *
     * This is the actual scanner method that we use instead of scan().
     */
    public function scanAST($tree, string $filename): array
    {
        $parsedFunctions = [];
        $this->extractGettextFunctions($tree, $filename, $parsedFunctions);

        return $parsedFunctions;
    }

    /**
     * Traverses through the tree and checks functions for possible match and extraction.
     */
    private function extractGettextFunctions($node, $filename, &$parsedFunctions)
    {
        if ($node instanceof FunctionExpression) {
            $function = $this->createFunction($node, $filename);
            if ($function) {
                $parsedFunctions[] = $function;
            }
            return;
        }

        foreach ($node->getIterator() as $child) {
            $this->extractGettextFunctions($child, $filename, $parsedFunctions);
        }
    }

    /**
     * Creates a record about a recognized function and its translatable message.
     */
    private function createFunction(FunctionExpression $node, $filename)
    {
        $name = $node->getAttribute('name');
        // Check if this is a recognized function.
        if (!in_array($name, $this->functions, true)) {
            return null;
        }

        $line = $node->getTemplateLine();
        $function = new ParsedFunction($name, $filename, $line);

        foreach ($node->getNode('arguments')->getIterator() as $argument) {
            // Check if this function's arguments are literals, and not expressions.
            if (!$argument->hasAttribute('value')) {
                // If it uses expressions, ignore this function.
                return null;
            }

            $arg = trim($argument->getAttribute('value'));
            $function->addArgument($arg);
        }

        return $function;
    }
}
