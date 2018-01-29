<?php namespace Pikanji\Agent\Tests\Unit;

use Agent;
use PluginTestCase;

/**
 * Class PluginTest
 *
 * Test for Plugin class. This test requires to add 2 line below after
 * `$plugin = $manager->loadPlugin($namespace, $path);` in PluginTestCase class.
 * ```
 * $manager->registerPlugin($plugin);
 * $manager->bootPlugin($plugin);
 * ```
 * 
 * @see https://github.com/octobercms/october/issues/1833#issuecomment-193202296
 *
 * @package Pikanji\Agent\Tests\Unit
 */
class PluginTest extends PluginTestCase
{
    /**
     * Checks if Agent facade is available.
     */
    public function testAgentFacade()
    {
        Agent::setUserAgent('Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36');
        $this->assertSame('Chrome', Agent::browser());
    }
}

