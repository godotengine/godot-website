<?php namespace RainLab\Translate\Classes;

use Cms\Classes\Page;
use Cms\Classes\Theme;
use Cms\Classes\Layout;
use Cms\Classes\Partial;
use RainLab\Translate\Models\Message;
use RainLab\Translate\Classes\Translator;
use System\Models\MailTemplate;

/**
 * Theme scanner class
 *
 * @package rainlab\translate
 * @author Alexey Bobkov, Samuel Georges
 */
class ThemeScanner
{
    /**
     * Helper method for scanForMessages()
     * @return void
     */
    public static function scan()
    {
        $obj = new static;

        return $obj->scanForMessages();
    }

    /**
     * Scans theme templates and config for messages.
     * @return void
     */
    public function scanForMessages()
    {
        $this->scanThemeConfigForMessages();
        $this->scanThemeTemplatesForMessages();
        $this->scanMailTemplatesForMessages();
    }

    /**
     * Scans the theme configuration for defined messages
     * @return void
     */
    public function scanThemeConfigForMessages()
    {
        $theme = Theme::getActiveTheme();
        $config = $theme->getConfigArray('translate');

        if (!count($config)) {
            return;
        }

        $translator = Translator::instance();
        $keys = [];

        foreach ($config as $locale => $messages) {
            if (is_string($messages)) {
                // $message is a yaml filename, load the yaml file
                $messages = $theme->getConfigArray('translate.'.$locale);
            }
            $keys = array_merge($keys, array_keys($messages));
        }

        Message::importMessages($keys);

        foreach ($config as $locale => $messages) {
            if (is_string($messages)) {
                // $message is a yaml filename, load the yaml file
                $messages = $theme->getConfigArray('translate.'.$locale);
            }
            Message::importMessageCodes($messages, $locale);
        }
    }

    /**
     * Scans the theme templates for message references.
     * @return void
     */
    public function scanThemeTemplatesForMessages()
    {
        $messages = [];

        foreach (Layout::all() as $layout) {
            $messages = array_merge($messages, $this->parseContent($layout->markup));
        }

        foreach (Page::all() as $page) {
            $messages = array_merge($messages, $this->parseContent($page->markup));
        }

        foreach (Partial::all() as $partial) {
            $messages = array_merge($messages, $this->parseContent($partial->markup));
        }

        Message::importMessages($messages);
    }

    /**
     * Scans the mail templates for message references.
     * @return void
     */
    public function scanMailTemplatesForMessages()
    {
        $messages = [];

        foreach (MailTemplate::allTemplates() as $mailTemplate) {
            $messages = array_merge($messages, $this->parseContent($mailTemplate->subject));
            $messages = array_merge($messages, $this->parseContent($mailTemplate->content_html));
        }

        Message::importMessages($messages);
    }

    /**
     * Parse the known language tag types in to messages.
     * @param  string $content
     * @return array
     */
    protected function parseContent($content)
    {
        $messages = [];
        $messages = array_merge($messages, $this->processStandardTags($content));

        return $messages;
    }

    /**
     * Process standard language filter tag (_|)
     * @param  string $content
     * @return array
     */
    protected function processStandardTags($content)
    {
        $messages = [];

        /*
         * Regex used:
         *
         * {{'AJAX framework'|_}}
         * {{\s*'([^'])+'\s*[|]\s*_\s*}}
         *
         * {{'AJAX framework'|_(variables)}}
         * {{\s*'([^'])+'\s*[|]\s*_\s*\([^\)]+\)\s*}}
         */

        $quoteChar = preg_quote("'");

        preg_match_all('#{{\s*'.$quoteChar.'([^'.$quoteChar.']+)'.$quoteChar.'\s*[|]\s*_\s*}}#', $content, $match);
        if (isset($match[1])) {
            $messages = array_merge($messages, $match[1]);
        }

        preg_match_all('#{{\s*'.$quoteChar.'([^'.$quoteChar.']+)'.$quoteChar.'\s*[|]\s*_\s*\([^\)]+\)\s*}}#', $content, $match);
        if (isset($match[1])) {
            $messages = array_merge($messages, $match[1]);
        }

        $quoteChar = preg_quote('"');

        preg_match_all('#{{\s*'.$quoteChar.'([^'.$quoteChar.']+)'.$quoteChar.'\s*[|]\s*_\s*}}#', $content, $match);
        if (isset($match[1])) {
            $messages = array_merge($messages, $match[1]);
        }

        preg_match_all('#{{\s*'.$quoteChar.'([^'.$quoteChar.']+)'.$quoteChar.'\s*[|]\s*_\s*\([^\)]+\)\s*}}#', $content, $match);
        if (isset($match[1])) {
            $messages = array_merge($messages, $match[1]);
        }

        return $messages;
    }
}
