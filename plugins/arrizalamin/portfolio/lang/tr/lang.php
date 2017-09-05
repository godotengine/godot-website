<?php

return [
    'plugin' => [
        'name' => 'Portföy',
        'description' => 'Projelerinizi göstermeye izin even bir eklenti.',
    ],
    'navigation' => [
        'label' => 'Portföy',
        'sideMenu' => [
            'items' => 'Öğeler',
            'categories' => 'Kategoriler',
            'tags' => 'Etiketler'
        ]
    ],
    'permissions' => [
        'tab' => 'Portföy',
        'manage' => 'Portföy Yönet'
    ],
    'components' => [
        'portfolio' => [
            'name' => 'Portföy listesi',
            'description' => 'Bir portföy listesi oluştur.',
            'properties' => [
                'category' => [
                    'title' => 'Kategori',
                    'placeholder' => 'Kategori Seç',
                    'all' => 'All'
                ],
                'pageNumber' => [
                    'title' => 'Sayfa Numarası',
                    'description' => 'Bu değer, sayfa kullanım belirlemek için kullanılır.'
                ],
                'itemsPerPage' => [
                    'title' => 'Sayfa başı öğeler',
                    'validationMessage' => 'Sayfa başı öğleri için geçersiz biçim'
                ],
                'order' => [
                    'title' => 'Sıralama',
                    'placeholder' => 'Sıralamayı Seç',
                    'ascending' => 'Artan',
                    'descending' => 'Azalan'
                ],
                'group' => [
                    'advanced' => 'Gelişmiş',
                    'links' => 'Bağlantılar'
                ],
                'selectedTag' => [
                    'title' => 'Seçilen etiket',
                    'description' => 'Bu değeri değiştirmeyin (default: {{ :selected_tag }})'
                ],
                'selectedCat' => [
                    'title' => 'Seçilen kategori',
                    'description' => 'Bu değeri değiştirmeyin (default: {{ :selected_cat }})'
                ],
                'itemPage' => [
                    'title' => 'Öğe sayfası',
                    'description' => 'Portföy öğeleri görüntülendiği sayfa.'
                ],
                'tagListPage' => [
                    'title' => 'Etiket listesi sayfası',
                    'description' => 'Etikete ile eşleşen portföy öğelerinin listelendiği sayfa.'
                ],
                'catListPage' => [
                    'title' => 'Kategori sayfası',
                    'description' => 'Seçilen kategoriye ait portföy öğeleri listelendiği sayfa.'
                ],
            ],
        ],
        'item' => [
            'name' => 'Portföy Öğesi',
            'description' => 'Portföy koleksiyonun tek bir öğesini görüntüler.',
            'properties' => [
                'item' => [
                    'title' => 'Öğeyi göstermek için',
                    'description' => 'Göstermek için bir öğe seçin. URL öğesi seçim tarafından geçersiz kılınır.',
                    'none' => 'Yok',
                ],
                'itemSlug' => [
                    'title' => 'Öğe slug',
                    'description' => 'Öğe slug URL tanımlayıcı'
                ],
            ],
        ],
    ],
    'controller' => [
        'view' => [
            'items' => [
                'new' => 'Yeni Öğe',
                'breadcrumb_label' => 'Öğeler',
                'return' => 'Öğeler listesine geri dön',
                'creating' => 'Öğe Oluşturuluyor...',
                'delete_confirmation' => 'Gerçekten bu öğeyi silmek istiyor musunuz?'
            ],
            'categories' => [
                'new' => 'Yeni Öğe',
                'breadcrumb_label' => 'Kategoriler',
                'return' => 'Kategoriler listesine geri dön',
                'creating' => 'Kategori Oluşturuluyor...',
                'delete_confirmation' => 'Gerçekten bu kategoriyi silmek istiyor musunuz?'
            ],
            'tags' => [
                'new' => 'Yeni Etiket',
                'breadcrumb_label' => 'Etiketler',
                'return' => 'Etiketler listesine geri dön',
                'creating' => 'Etiket Oluşturuluyor...',
                'delete_confirmation' => 'Gerçekten bu etiketi silmek istiyor musunuz?'
            ]
        ],
        'list' => [
            'items' => 'Öğeleri Yönet',
            'categories' => 'Kategorileri Yönet',
            'tags' => 'Etiketleri Yönet'
        ],
        'form' => [
            'items' => [
                'title' => 'Öğe',
                'create' => 'Öğe Oluştur',
                'update' => 'Öğe Güncelle',
                'flashCreate' => 'Öğe başarıyla oluşturuldu',
                'flashUpdate' => 'Öğe başarıyla güncellendi',
                'flashDelete' => 'Öğe başarıyla silindi'
            ],
            'categories' => [
                'title' => 'Kategori',
                'create' => 'Kategori Oluştur',
                'update' => 'Kategori Güncelle',
                'flashCreate' => 'Kategori başarıyla oluşturuldu',
                'flashUpdate' => 'Kategori başarıyla güncellendi',
                'flashDelete' => 'Kategori başarıyla silindi'
            ],
            'tags' => [
                'title' => 'Etiketler',
                'create' => 'Etiket Oluştur',
                'update' => 'Etiket güncelle',
                'flashCreate' => 'Etiket başarıyla oluşturuldu',
                'flashUpdate' => 'Etiket başarıyla güncellendi',
                'flashDelete' => 'Etiket başarıyla silindi'
            ]
        ],
    ],
    'columns' => [
        'item' => [
            'id' => 'ID',
            'title' => 'Başlık',
            'category' => 'Kategori',
            'tags' => 'Etiketler'
        ],
        'category' => [
            'id' => 'ID',
            'name' => 'Ad',
            'description' => 'Açıklama'
        ],
        'tag' => [
            'id' => 'ID',
            'name' => 'Ad',
            'items' => 'Etiketli öğeler'
        ]
    ],
    'fields' => [
        'item' => [
            'title' => 'Başlık',
            'category' => 'Kategori',
            'slug' => 'Slug',
            'tags' => 'Etiketler',
            'description' => 'Açıklama',
            'images' => 'Resimler',
            'url' => 'URL'
        ],
        'category' => [
            'name' => 'Ad',
            'slug' => 'Slug',
            'description' => 'Açıklama'
        ],
        'tag' => [
            'name' => 'Ad',
            'items' => 'Öğeler',
            'notavailable' => 'Öğeler kullanılabilir değil'
        ]
    ],
];
