<?php namespace Owl\FormWidgets\Tagbox;

use Backend\Classes\FormField;
use Backend\Classes\FormWidgetBase;

class Widget extends FormWidgetBase
{

    /**
     * Render the form widget
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('widget');
    }

    /**
     * Prepare widget variables
     */
    public function prepareVars()
    {
        // Break key codes
        if (isset($this->config->breakCodes)) {
            $config['breakCodes'] = is_array($this->config->breakCodes)
                ? $this->config->breakCodes
                : [$this->config->breakCodes];
        } else {
            $config['breakCodes'] = [13, 9];
        }

        // Slugify
        $config['slugify'] = isset($this->config->slugify) &&
            filter_var($this->config->slugify, FILTER_VALIDATE_BOOLEAN);

        // Accepted characters
        $config['filter'] = isset($this->config->filter)
            ? $this->config->filter
            : false;

        // Validation rules
        $config['validation'] = isset($this->config->validation)
            ? $this->config->validation
            : false;

        // Validation message
        $config['validationMessage'] = isset($this->config->validationMessage)
            ? $this->config->validationMessage
            : 'The tag format is invalid.';

        // Disable auto-focus
        $config['autofocus'] = isset($this->config->autofocus)
            ? (bool) $this->config->autofocus
            : true;

        // Javascript configuration
        $config['fieldName'] = $this->fieldName;
        $this->vars['config'] = htmlspecialchars(json_encode($config));

        // Pre-populated tags
        $fieldName = $this->fieldName;
        $this->vars['tags'] = is_array($this->model->$fieldName)
            ? implode(',', $this->model->$fieldName)
            : false;

        // Placeholder
        $this->vars['placeholder'] = isset($this->config->placeholder)
            ? htmlspecialchars($this->config->placeholder)
            : "Enter tags...";

        // Prepopulated tags
        $tags = [];
        if (is_array($this->model->$fieldName) && count($this->model->$fieldName)) {
            foreach ($this->model->$fieldName as $tag)
                $tags[] = htmlspecialchars($tag);
        } else if ($loadValue = $this->getLoadValue()) {
            $loadValue = json_decode($loadValue, true);
            if ($loadValue && is_array($loadValue)) {
                foreach ($loadValue as $tag) {
                    if (empty($tag))
                        continue;
                    $tags[] = htmlspecialchars($tag);
                }
            }
        }

        $this->vars['tags'] = $tags;
    }

    /**
     * Load widget assets
     */
    public function loadAssets()
    {
        $this->addJs('js/tagbox.js');

        if (isset($this->config->cssPath) && $this->config->cssPath)
            $this->addCss($this->config->cssPath);

        elseif (!isset($this->config->cssPath))
            $this->addCss('css/tagbox.css');
    }

    /**
     * Return save value
     * @return  array
     */
    public function getSaveValue($value)
    {
        $data   = [];
        foreach (post($this->fieldName) as $field) {
            if (empty($field))
                continue;
            $data[] = $field;
        }

        return $data;
    }

}
