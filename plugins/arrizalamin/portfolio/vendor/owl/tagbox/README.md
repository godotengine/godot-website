# Tagbox
Tag form widget for OctoberCMS.

![Packagist](https://img.shields.io/packagist/dt/owl/tagbox.svg)

### Installation
To install the Tagbox widget with your plugin, add the following to your plugin's ```composer.json``` file.

```json
"require": {
    "owl/tagbox": "~1.0@dev"
}
```
Next, register the widget in your plugin's ```Plugin.php``` file.
```php
public function registerFormWidgets()
{
    return [
        'Owl\FormWidgets\Tagbox\Widget' => [
            'label' => 'Tagbox',
            'code'  => 'owl-tagbox'
        ],
    ];
}
```

### Usage
To use the Tagbox widget, simply declare a field type as ```owl-tagbox```
```yaml
tags:
    label: Tags
    type: owl-tagbox
```
If tags *are not* being stored through a related model, the model attribute must be [jsonable](http://octobercms.com/docs/database/model#attribute-modifiers). If tags *are* being stored through a related model, the ```getTagsAttribute``` and ```setTagsAttribute``` methods must be declared to process the relationship. These methods should return / accept an array of strings.

Validation can be performed on tags by defining a ```validation``` regular expression parameter. A ```validationMessage``` can also be defined for custom error messages. For example, if you are accepting an array of emails, something like this could be used to validate the tagbox values...

```yaml
emails:
    label: Email Addresses
    type: owl-tagbox
    validation: ^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$
    validationMessage: Please enter a valid email address.
```

A ```filter``` expression may also be used to block unwanted characters. In the following example, we'll allow alpha-numeric characters, dashes, and underscores. The default css may be customized or removed by specifying a ```cssPath``` attribute.

```yaml
tags:
    label: Tags
    type: owl-tagbox
    filter: "[^a-zA-Z0-9_.-]+"
    cssPath: /plugins/vendor/plugin/assets/css/custom-tagbox.css
```

Lastly, a tag may be "slugified" upon entry by setting the ```slugify``` parameter to ```true```.
