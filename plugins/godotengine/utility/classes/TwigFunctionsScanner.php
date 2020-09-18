<?php

namespace GodotEngine\Utility\Classes;

use Twig\Node\Expression\FunctionExpression;
use \Gettext\Scanner\FunctionsScannerInterface;
use \Gettext\Scanner\ParsedFunction;

class TwigFunctionsScanner implements FunctionsScannerInterface
{
    protected $functions;

    public function __construct(array $functions = null)
    {
        $this->functions = $functions;
    }

    public function scan(string $code, string $filename): array
    {
        // This function is a dud, we don't use it because we work with available ASTs directly.
        // See scanAST for the actual implementation.
        return [];
    }

    public function scanAST($tree, string $filename): array
    {
        $parsedFunctions = [];
        $this->extractGettextFunctions($tree, $filename, $parsedFunctions);

        return $parsedFunctions;
    }

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

    private function createFunction(FunctionExpression $node, $filename)
    {
        $name = $node->getAttribute('name');
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
