<?php

return [
    'plugin' => [
        'name' => 'Metin Editörleri',
        'description' => 'Metin Editorünüzü CMS ve diğer Kod Editörüne ekleyin'
    ],
    'settings' => [
        'label' => 'Metin Editörleri',
        'description' => 'Metin editör tercihlerini bu bölümden yapılandırabilirsiniz.'
    ],
    'widget' => [
        'label' => 'Wysiwyg',
        'name' => 'Metin Editörleri',
        'description' => 'Kullanıcının seçtiği bir metin editörü oluşturur'
    ],
    'form' => [
        'settings' => [
            'select_editor' => 'Editör seç',
            'editor_width' => 'Editör Genişliği',
            'editor_height' => 'Editör Yüksekliği',
            'toolbar_label' => 'Araç Çubuğu özelleştirme',
            'toolbar_label_lg' => 'Araç Çubuğu özelleştirme (büyük)',
            'toolbar_label_md' => 'Araç Çubuğu özelleştirme (orta)',
            'toolbar_label_sm' => 'Araç Çubuğu özelleştirme (küçük)',
            'toolbar_label_xs' => 'Araç Çubuğu özelleştirme (hareketli)',
            'toolbar_tinymce' => 'Belgeleme: http://www.tinymce.com/docs/advanced/editor-control-identifiers/#toolbarcontrols',
            'toolbar_ckeditor' => 'Belgeleme: http://docs.ckeditor.com/#!/guide/dev_toolbar',
            'toolbar_froala_lg' => 'Belgeleme: https://www.froala.com/wysiwyg-editor/docs/options#toolbarButtons',
            'toolbar_froala_md' => 'Belgeleme: https://www.froala.com/wysiwyg-editor/docs/options#toolbarButtonsMD',
            'toolbar_froala_sm' => 'Belgeleme: https://www.froala.com/wysiwyg-editor/docs/options#toolbarButtonsSM',
            'toolbar_froala_xs' => 'Belgeleme: https://www.froala.com/wysiwyg-editor/docs/options#toolbarButtonsXS'
        ],
        'page' => [
            'label' => 'Sayfa için kullanım',
            'comment' => 'Sayfa düzenleme bölümünde Metin editörü kullanın'
        ],
        'content' => [
            'label' => 'İçerik için kullanım',
            'comment' => 'İçerik düzenleme bölümünde Metin editörü kullanın'
        ],
        'partial' => [
            'label' => 'Parça metinler için kullanım',
            'comment' => 'Parça metinler için Metin editörü kullanın'
        ],
        'layout' => [
            'label' => 'Şablonlar için kullanım',
            'comment' => 'Şablon düzenleme bölümünde Metin editörü kullanın'
        ],
        'others' => [
            'label' => 'Diğer modüller için kullanım',
            'comment' => '(Sayfa, Parça metinler, Şablonlar, İçerik) dışındaki tüm eklentiler için de seçilen Metin Editörünü kullan'
        ],
        'spages' => [
            'label' => 'Sabit sayfalar için kullanım',
            'comment' => 'Sabit sayfalar modülünde gönderi editörü olarak seçilen Metin editörünü kullan'
        ],
        'blog' => [
            'label' => 'Blog için kullanım',
            'comment' => 'Blog modülünde gönderi editörü olarak seçilen Metin editörünü kullan'
        ],
        'problog' => [
            'label' => 'Radiantweb Problog için kullanım',
            'comment' => 'Radientweb Problog modülünde gönderi editörü olarak seçilen Metin editörünü kullan'
        ],
        'proevent' => [
            'label' => 'Radiantweb ProEvents için kullanım',
            'comment' => 'Radiantweb ProEvents modülünde gönderi editörü olarak seçilen Metin editörünü kullan'
        ],
        'apages' => [
            'label' => 'Autumn Sayfalar için kullanım',
            'comment' => 'Autumn Sayfalar modülünde gönderi editörü olarak seçilen Metin editörünü kullan'
        ],
        'cplus' => [
            'label' => 'Indikator Content Plus için kullanım',
            'comment' => 'Indikator Content Plus modülünde gönderi editörü olarak seçilen Metin editörünü kullan'
        ],
        'news' => [
            'label' => 'Indikator News & Newsletter için kullanım',
            'comment' => 'Indikator News & Newsletter modülünde gönderi editörü olarak seçilen Metin editörünü kullan'
        ],
        'tab' => [
            'settings' => 'Ayarlar',
            'content' => 'İçerik',
            'section' => 'Eklentiler'
        ]
    ]
];
