<?php namespace ShahiemSeymor\Bbcode;

use Backend;
use Decoda;
use URL;
use System\Classes\PluginBase;
use ShahiemSeymor\Bbcode\Models\Emoticon;
use ShahiemSeymor\Bbcode\Models\Settings;

class Plugin extends PluginBase
{

    public function pluginDetails()
    {
        return [
            'name'        => 'BBcode',
            'description' => 'The plugin implements a BBCode filter and a front-end wysiwyg editor.',
            'author'      => 'ShahiemSeymor',
            'icon'        => 'icon-bold'
        ];
    }

    public function registerComponents()
    {
        return [
            'ShahiemSeymor\Bbcode\Components\Editor'  => 'wysibbEditor',
        ];
    }

    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'bbcode' => [$this, 'textToBBcode']
            ]
        ];
    }

    public function textToBBcode($text)
    {
        $whitelist = explode(",", Settings::get('whitelist_tags'));

        $code = new Decoda\Decoda($text, array(
            'xhtmlOutput' => true,
            'strictMode'  => false,
            'escapeHtml'  => false
        ));

        $code->addFilter(new \Decoda\Filter\ImageFilter());
        $code->addHook(new \Decoda\Hook\EmoticonHook(array('path' => URL::to('plugins/shahiemseymor/bbcode/emoticons').'/')));
        $code->whitelist($whitelist)->addFilter(new \Decoda\Filter\DefaultFilter());

        if(trim(Settings::get('language')) != '')
            $code->setLocale(Settings::get('language'));

        if(Settings::get('shorthand') == TRUE)
            $code->addFilter(new \Decoda\Filter\EmailFilter())->addFilter(new \Decoda\Filter\UrlFilter())->setShorthand($text);

        $code->defaults();
        
        return $code->parse();
    }

    public function registerSettings()
    {
        return [
            'emoticons' => [
                'label'       => 'Emoticons',
                'description' => 'Manage emoticons.',
                'category'    => 'BBCode',
                'icon'        => 'icon-smile-o',
                'url'       =>  Backend::url('shahiemseymor/bbcode/emoticons')
            ],
            'settings' => [
                'label'       => 'Settings',
                'description' => 'Manage bbcode settings.',
                'category'    => 'BBCode',
                'icon'        => 'icon-bold',
                'class'       => 'ShahiemSeymor\Bbcode\Models\Settings'
            ]
        ];
    }

}
