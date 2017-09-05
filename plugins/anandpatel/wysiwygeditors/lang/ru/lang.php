<?php

return [
    'plugin' => [
        'name' => 'Визуальный редактор',
        'description' => 'Используйте ваши любимые визуальные редакторы в CMS'
    ],
    'settings' => [
        'label' => 'Визуальный редактор',
        'description' => 'Настройки визуального редактора.'
    ],
    'widget' => [
        'label' => 'Wysiwyg',
        'name' => 'Визуальный редактор',
        'description' => 'Отображает выбранный пользователем визуальный редактор'
    ],
    'form' => [
        'settings' => [
            'select_editor' => 'Выберите редактор',
            'editor_width' => 'Ширина окна редактора',
            'editor_height' => 'Высота окна редактора',
            'toolbar_label' => 'Панель инструментов настройки',
            'toolbar_label_lg' => 'Панель инструментов настройки (большой)',
            'toolbar_label_md' => 'Панель инструментов настройки (средний)',
            'toolbar_label_sm' => 'Панель инструментов настройки (маленький)',
            'toolbar_label_xs' => 'Панель инструментов настройки (мобильный)',
            'toolbar_tinymce' => 'документация: http://www.tinymce.com/docs/advanced/editor-control-identifiers/#toolbarcontrols',
            'toolbar_ckeditor' => 'документация: http://docs.ckeditor.com/#!/guide/dev_toolbar',
            'toolbar_froala_lg' => 'документация: https://www.froala.com/wysiwyg-editor/docs/options#toolbarButtons',
            'toolbar_froala_md' => 'документация: https://www.froala.com/wysiwyg-editor/docs/options#toolbarButtonsMD',
            'toolbar_froala_sm' => 'документация: https://www.froala.com/wysiwyg-editor/docs/options#toolbarButtonsSM',
            'toolbar_froala_xs' => 'документация: https://www.froala.com/wysiwyg-editor/docs/options#toolbarButtonsXS'
        ],
        'page' => [
            'label' => 'Использовать для страниц в CMS?',
            'comment' => 'Включить визуальный редактор для страниц в CMS'
        ],
        'content' => [
            'label' => 'Использовать для содержимого в CMS?',
            'comment' => 'Включить визуальный редактор для содержимого в CMS'
        ],
        'partial' => [
            'label' => 'Использовать для фрагментов в CMS?',
            'comment' => 'Включить визуальный редактор для фрагментов в CMS'
        ],
        'layout' => [
            'label' => 'Использовать для шаблонов в CMS?',
            'comment' => 'Включить визуальный редактор для шаблонов в CMS'
        ],
        'others' => [
            'label' => 'Использовать для остального?',
            'comment' => 'Включить визуальный редактор для всех плагинов кроме разделов CMS (Страницы, Фрагменты, Шаблоны, Содержимое)'
        ],
        'spages' => [
            'label' => 'Использовать в RainLab Static Pages?',
            'comment' => 'Включить визуальный редактор в плагине Radientweb Problog для редактирования кода страниц'
        ],
        'blog' => [
            'label' => 'Использовать в RainLab Blog?',
            'comment' => 'Включить визуальный редактор в плагине RainLab Blog для редактирования записей'
        ],
        'problog' => [
            'label' => 'Использовать в Radiantweb Problog?',
            'comment' => 'Включить визуальный редактор в плагине Radientweb Problog для редактирования записей'
        ],
        'proevent' => [
            'label' => 'Использовать в Radiantweb ProEvents?',
            'comment' => 'Включить визуальный редактор в плагине Radientweb ProEvents для редактирования описания события'
        ],
        'apages' => [
            'label' => 'Использовать в Autumn Pages?',
            'comment' => 'Включить визуальный редактор в плагине Autumn Pages для редактирования записей'
        ],
        'cplus' => [
            'label' => 'Использовать в Indikator Content Plus?',
            'comment' => 'Включить визуальный редактор в плагине Indikator Content Plus для редактирования содержание'
        ],
        'news' => [
            'label' => 'Использовать в Indikator News & Newsletter?',
            'comment' => 'Включить визуальный редактор в плагине Indikator News & Newsletter для редактирования новости'
        ],
        'tab' => [
            'settings' => 'Настройки',
            'content' => 'Место использование',
            'section' => 'Плагины'
        ]
    ]
];
