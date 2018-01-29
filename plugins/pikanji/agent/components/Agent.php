<?php namespace Pikanji\Agent\Components;

use Cms\Classes\ComponentBase;
use Jenssegers\Agent\Agent as JenssegersAgent;

class Agent extends ComponentBase
{
    private $agent;

    public function componentDetails()
    {
        return [
            'name'        => 'Agent Component',
            'description' => 'A simple wrapper plugin for jenssegers/agent which provides browser/platform information.'
        ];
    }

    public function init()
    {
        $this->agent = new JenssegersAgent();
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this->agent, $name)) {
            $refMethod = new \ReflectionMethod('Jenssegers\Agent\Agent', $name);
            return $refMethod->invokeArgs($this->agent, $arguments);
        } else {
            return $this->agent->__call($name, $arguments);
        }
    }
}
