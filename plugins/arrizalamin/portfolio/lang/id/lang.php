<?php

return [
    'plugin' => [
        'name' => 'Portofolio',
        'description' => 'Plugin untuk menampilkan proyek yang sudah kamu kerjakan.',
    ],
    'navigation' => [
        'label' => 'Portofolio',
        'sideMenu' => [
            'items' => 'Item',
            'categories' => 'Kategori'
        ]
    ],
    'components' => [
        'portfolio' => [
            'name' => 'Portofolio',
            'description' => 'Buat daftar portofolio.',
        ],
    ],
    'permissions' => [
        'tab' => 'Portfolio',
        'manage' => 'Manajemen Portfolio'
    ],
    'controller' => [
        'view' => [
            'items' => [
                'new' => 'Buat Item',
                'breadcrumb_label' => 'Item',
                'return' => 'Kembali ke daftar item',
                'creating' => 'Membuat Item...',
                'delete_confirmation' => 'Kamu yakin mau menghapus item ini?' 
            ],
            'categories' => [
                'new' => 'Buat Kategori',
                'breadcrumb_label' => 'Kategori',
                'return' => 'Kembali ke daftar kategori',
                'creating' => 'Membuat Kategori...',
                'delete_confirmation' => 'Kamu yakin mau menghapus kategori ini?' 
            ]
        ],
        'list' => [
            'items' => 'Kelola Item',
            'categories' => 'Kelola Kategori'
        ],
        'form' => [
            'items' => [
                'title' => 'Item',
                'create' => 'Buat Item',
                'update' => 'Perbarui Item',
                'flashCreate' => 'Item sukses dibuat',
                'flashUpdate' => 'Item sukses diperbarui',
                'flashDelete' => 'Item sukses dihapus'
            ],
            'categories' => [
                'title' => 'Kategori',
                'create' => 'Buat Kategori',
                'update' => 'Perbarui Kategori',
                'flashCreate' => 'Kategori sukses dibuat',
                'flashUpdate' => 'Kategori sukses diperbarui',
                'flashDelete' => 'Kategori sukses dihapus'

            ]
        ],
    ],
    'columns' => [
        'item' => [
            'id' => 'ID',
            'title' => 'Judul',
            'category' => 'Kategori'
        ],
        'category' => [
            'id' => 'ID',
            'name' => 'Nama',
            'description' => 'Deskripsi'
        ]
    ],
    'fields' => [
        'item' => [
            'title' => 'Judul',
            'category' => 'Kategori',
            'description' => 'Deskripsi',
            'images' => 'Gambar',
            'url' => 'URL'
        ],
        'category' => [
            'name' => 'Nama',
            'description' => 'Deskripsi'
        ]
    ],
];
