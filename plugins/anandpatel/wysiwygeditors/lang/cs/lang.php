<?php

return [
    'plugin' => [
        'name' => 'Wysiwyg editory',
        'description' => 'Vložte svůj oblíbený Wysiwyg editor do CMS a dalších editorů kódu'
    ],
    'settings' => [
        'label' => 'Wysiwyg editory',
        'description' => 'Nastavení předvoleb Wysiwyg editorů.'
    ],
    'widget' => [
        'label' => 'Wysiwyg',
        'name' => 'Wysiwyg editory',
        'description' => 'Vykreslí Wysiwyg editor dle vašeho výběru'
    ],
    'form' => [
        'settings' => [
            'select_editor' => 'Použitý typ editoru',
            'editor_width' => 'Šířka editoru',
            'editor_height' => 'Výška editoru',
            'toolbar_label' => 'Toolbar customization',
            'toolbar_label_lg' => 'Toolbar customization (velký)',
            'toolbar_label_md' => 'Toolbar customization (střední)',
            'toolbar_label_sm' => 'Toolbar customization (malý)',
            'toolbar_label_xs' => 'Toolbar customization (mobilní)',
            'toolbar_tinymce' => 'Dokumentace: http://www.tinymce.com/docs/advanced/editor-control-identifiers/#toolbarcontrols',
            'toolbar_ckeditor' => 'Dokumentace: http://docs.ckeditor.com/#!/guide/dev_toolbar',
            'toolbar_froala_lg' => 'Dokumentace: https://www.froala.com/wysiwyg-editor/docs/options#toolbarButtons',
            'toolbar_froala_md' => 'Dokumentace: https://www.froala.com/wysiwyg-editor/docs/options#toolbarButtonsMD',
            'toolbar_froala_sm' => 'Dokumentace: https://www.froala.com/wysiwyg-editor/docs/options#toolbarButtonsSM',
            'toolbar_froala_xs' => 'Dokumentace: https://www.froala.com/wysiwyg-editor/docs/options#toolbarButtonsXS'
        ],
	    'page' => [
            'label' => 'Použít editor pro stránky?',
            'comment' => 'Použije editor pro stránky (Pages)'
        ],
        'content' => [
            'label' => 'Použít editor pro obsahové bloky?',
            'comment' => 'Použije editor pro obsahové bloky (Content)'
        ],
        'partial' => [
            'label' => 'Použít editor pro prvky stránek?',
            'comment' => 'Použije editor pro prvky stránek (Partials)'
        ],
        'layout' => [
            'label' => 'Použije editor pro layouty?',
            'comment' => 'Použije editor pro layout stránek (Layouts)'
        ],
        'others' => [
            'label' => 'Použít editor pro vše ostatní?',
            'comment' => 'Nahradí všechny výskyty editoru kódu ve všech pluginech s vyjímkou CMS (Stránky, Obsahové bloky, Prvky stránky a Layouty)'
        ],
        'spages' => [
            'label' => 'Použít pro RainLab Static Pages?',
            'comment' => 'Použije Wysiwyg editor pro RainLab Static Pages plugin jako editor stránek'
        ],
        'blog' => [
            'label' => 'Použít pro RainLab Blog?',
            'comment' => 'Použije Wysiwyg editor pro RainLab blog plugin jako editor článků'
        ],
        'problog' => [
            'label' => 'Použít pro Radiantweb Problog?',
            'comment' => 'Použije Wysiwyg editor pro Radientweb Problog plugin jako editor článků'
        ],
        'proevent' => [
            'label' => 'Použít pro Radiantweb ProEvents?',
            'comment' => 'Použije Wysiwyg editor pro Radientweb ProEvents plugin jako editor detailů událostí'
        ],
        'apages' => [
            'label' => 'Použít pro Autumn Pages?',
            'comment' => 'použije Wysiwyg editor pro Autumn Pages plugin jako editor stránek'
        ],
        'cplus' => [
            'label' => 'Použít pro Indikator Content Plus?',
            'comment' => 'použije Wysiwyg editor pro Indikator Content Plus plugin jako editor obsah'
        ],
        'news' => [
            'label' => 'Použít pro Indikator News & Newsletter?',
            'comment' => 'použije Wysiwyg editor pro Indikator News & Newsletter plugin jako editor zprávy'
        ],
        'tab' => [
            'settings' => 'Nastavení editoru',
            'content' => 'Použití editoru',
            'section' => 'Pluginy'
        ]
    ]
];
