<?php

return [
    'plugin' => [
        'name' => 'Wysiwyg Editors',
        'description' => '在CMS或者其它代码编辑器中使用你最喜欢的可视化编辑器'
    ],
    'settings' => [
        'label' => 'Wysiwyg Editors',
        'description' => '编辑所见即所得编辑器属性。'
    ],
    'widget' => [
        'label' => 'Wysiwyg',
        'name' => 'Wysiwyg Editors',
        'description' => '渲染一个用户选择的所见即所得编辑器'
    ],
    'form' => [
        'settings' => [
            'select_editor' => '选择编辑器',
            'editor_width' => '编辑器宽度',
            'editor_height' => '编辑器高度',
            'toolbar_label' => '定制工具栏',
            'toolbar_label_lg' => '定制工具栏 (大)',
            'toolbar_label_md' => '定制工具栏 (中)',
            'toolbar_label_sm' => '定制工具栏 (小)',
            'toolbar_label_xs' => '定制工具栏 (移动)',
            'toolbar_tinymce' => '文件: http://www.tinymce.com/docs/advanced/editor-control-identifiers/#toolbarcontrols',
            'toolbar_ckeditor' => '文件: http://docs.ckeditor.com/#!/guide/dev_toolbar',
            'toolbar_froala_lg' => '文件: https://www.froala.com/wysiwyg-editor/docs/options#toolbarButtons',
            'toolbar_froala_md' => '文件: https://www.froala.com/wysiwyg-editor/docs/options#toolbarButtonsMD',
            'toolbar_froala_sm' => '文件: https://www.froala.com/wysiwyg-editor/docs/options#toolbarButtonsSM',
            'toolbar_froala_xs' => '文件: https://www.froala.com/wysiwyg-editor/docs/options#toolbarButtonsXS'
        ],
        'page' => [
            'label' => '在CMS - 页面中使用?',
            'comment' => '在 CMS页面 中使用Wysiwyg'
        ],
        'content' => [
            'label' => '在CMS - 内容中使用?',
            'comment' => '在 CMS内容 中使用Wysiwyg'
        ],
        'partial' => [
            'label' => '在CMS - 部件中使用?',
            'comment' => '在 CMS部件 中使用Wysiwyg'
        ],
        'layout' => [
            'label' => '在CMS - 布局中使用?',
            'comment' => '在 CMS布局 中使用Wysiwyg'
        ],
        'others' => [
            'label' => '在其它地方使用?',
            'comment' => '在除开CMS(页面、部件、布局、内容)的其它所有编辑器中使用Wysiwyg'
        ],
        'spages' => [
            'label' => '在RainLab Static Pages中使用?',
            'comment' => '在RainLab Static Pages插件中使用Wysiwyg'
        ],
        'blog' => [
            'label' => '在RainLab Blog中使用?',
            'comment' => '在RainLab Blog插件中使用Wysiwyg'
        ],
        'problog' => [
            'label' => '在Radiantweb Problog中使用?',
            'comment' => '在Radientweb Problog插件中使用Wysiwyg'
        ],
        'proevent' => [
            'label' => '在Radiantweb ProEvents中使用?',
            'comment' => '在Radientweb ProEvents插件中使用Wysiwyg'
        ],
        'apages' => [
            'label' => '在Autumn Pages中使用?',
            'comment' => '在Autumn Pages插件中使用Wysiwyg'
        ],
        'cplus' => [
            'label' => '在Indikator Content Plus中使用?',
            'comment' => '在Indikator Content Plus插件中使用Wysiwyg'
        ],
        'news' => [
            'label' => '在Indikator News & Newsletter中使用?',
            'comment' => '在Indikator News & Newsletter插件中使用Wysiwyg'
        ],
        'tab' => [
            'settings' => '设置',
            'content' => '使用范围',
            'section' => '插件'
        ]
    ]
];
