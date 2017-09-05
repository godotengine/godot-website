<?php

return [
    'plugin' => [
        'name' => 'Wysiwyg Editors',
        'description' => 'Inject your favorite Wysiwyg Editor to CMS and other Code Editor'
    ],
    'settings' => [
        'label' => 'Wysiwyg Editors',
        'description' => 'Configure Wysiwyg Editors preferences.'
    ],
    'widget' => [
        'label' => 'Wysiwyg',
        'name' => 'Wysiwyg Editors',
        'description' => 'Renders a wysiwyg editor of user`s choice'
    ],
    'form' => [
        'settings' => [
            'select_editor' => 'Select editor',
            'editor_width' => 'Editor width',
            'editor_height' => 'Editor height',
            'toolbar_label' => 'Toolbar customization',
            'toolbar_label_lg' => 'Toolbar customization (large)',
            'toolbar_label_md' => 'Toolbar customization (medium)',
            'toolbar_label_sm' => 'Toolbar customization (small)',
            'toolbar_label_xs' => 'Toolbar customization (modile)',
            'toolbar_tinymce' => 'Documentation: http://www.tinymce.com/docs/advanced/editor-control-identifiers/#toolbarcontrols',
            'toolbar_ckeditor' => 'Documentation: http://docs.ckeditor.com/#!/guide/dev_toolbar',
            'toolbar_froala_lg' => 'Documentation: https://www.froala.com/wysiwyg-editor/docs/options#toolbarButtons',
            'toolbar_froala_md' => 'Documentation: https://www.froala.com/wysiwyg-editor/docs/options#toolbarButtonsMD',
            'toolbar_froala_sm' => 'Documentation: https://www.froala.com/wysiwyg-editor/docs/options#toolbarButtonsSM',
            'toolbar_froala_xs' => 'Documentation: https://www.froala.com/wysiwyg-editor/docs/options#toolbarButtonsXS'
        ],
        'page' => [
            'label' => 'Use for CMS - Page?',
            'comment' => 'Use Wysiwyg editor in CMS page'
        ],
        'content' => [
            'label' => 'Use for CMS - Content?',
            'comment' => 'Use Wysiwyg editor in CMS Content'
        ],
        'partial' => [
            'label' => 'Use for CMS - Partial?',
            'comment' => 'Use Wysiwyg editor in CMS Partial'
        ],
        'layout' => [
            'label' => 'Use for CMS - Layout?',
            'comment' => 'Use Wysiwyg editor in CMS Layout'
        ],
        'others' => [
            'label' => 'Use for others?',
            'comment' => 'Replace every instance of Code Editor with Wysiwyg Editor in all plugins except CMS (Page, Partial, Layout, Content)'
        ],
        'spages' => [
            'label' => 'Use for RainLab Static Pages?',
            'comment' => 'Use Wysiwyg editor in RainLab Static Pages plugin as page editor'
        ],
        'blog' => [
            'label' => 'Use for RainLab Blog?',
            'comment' => 'Use Wysiwyg editor in RainLab Blog plugin as post editor'
        ],
        'problog' => [
            'label' => 'Use for Radiantweb Problog?',
            'comment' => 'Use Wysiwyg editor in Radientweb Problog plugin as post editor'
        ],
        'proevent' => [
            'label' => 'Use for Radiantweb ProEvents?',
            'comment' => 'Use Wysiwyg editor in Radientweb ProEvents plugin as Event details editor'
        ],
        'apages' => [
            'label' => 'Use for Autumn Pages?',
            'comment' => 'Use Wysiwyg editor in Autumn Pages plugin as page editor'
        ],
        'cplus' => [
            'label' => 'Use for Indikator Content Plus?',
            'comment' => 'Use Wysiwyg editor in Indikator Content Plus plugin as content editor'
        ],
        'news' => [
            'label' => 'Use for Indikator News & Newsletter?',
            'comment' => 'Use Wysiwyg editor in Indikator Content News & Newsletter as news editor'
        ],
        'tab' => [
            'settings' => 'Settings',
            'content' => 'Content',
            'section' => 'Plugins'
        ]
    ]
];
