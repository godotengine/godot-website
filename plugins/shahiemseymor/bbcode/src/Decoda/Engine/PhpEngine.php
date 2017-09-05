<?php
/**
 * @copyright   2006-2014, Miles Johnson - http://milesj.me
 * @license     https://github.com/milesj/decoda/blob/master/license.md
 * @link        http://milesj.me/code/php/decoda
 */

namespace Decoda\Engine;

use Decoda\Exception\IoException;

/**
 * Renders tags by using PHP as template engine.
 */
class PhpEngine extends AbstractEngine {

    /**
     * {@inheritdoc}
     *
     * @throws \Decoda\Exception\IoException
     */
    public function render(array $tag, $content) {
        $setup = $this->getFilter()->getTag($tag['tag']);
        $attributes = $tag['attributes'];

        // Dashes aren't allowed in variables, so change to underscores
        foreach ($attributes as $key => $value) {
            $attributes[str_replace('-', '_', $key)] = $value;
        }

        foreach ($this->getPaths() as $path) {
            $template = sprintf('%s%s.php', $path, $setup['template']);

            if (file_exists($template)) {
                extract($attributes, EXTR_OVERWRITE);
                ob_start();

                include $template;

                return trim(ob_get_clean());
            }
        }

        throw new IoException(sprintf('Template file %s does not exist', $setup['template']));
    }

}