<?php

return [
    'plugin' => [
        'name' => 'Portfolio',
        'description' => 'Wtyczka pozwalająca pokazać swoje projekty.',
    ],
    'navigation' => [
        'label' => 'Portfolio',
        'sideMenu' => [
            'items' => 'Wpisy',
            'categories' => 'Kategorie'
        ]
    ],
    'permissions' => [
        'tab' => 'Portfolio',
        'manage' => 'Zarządzaj Portfolio'
    ],
    'components' => [
        'portfolio' => [
            'name' => 'Portfolio',
            'description' => 'Stwórz listę portfolio',
            'properties' => [
                'category' => [
                    'title' => 'Kategoria',
                    'placeholder' => 'Wybierz kategorię',
                    'all' => 'Wszystkie'
                ],
                'pageNumber' => [
                    'title' => 'Numer strony',
                    'description' => 'Ta wartość jest używana do określenia, na której stronie jest użytkownik.'
                ],
                'itemsPerPage' => [
                    'title' => 'Wpisów na stronę',
                    'validationMessage' => 'Nieprawidłowy format wartości wpisów na stronę'
                ],
                'order' => [
                    'title' => 'Kolejność',
                    'placeholder' => 'Wybierz kolejność',
                ]
            ]
        ],
    ],
    'controller' => [
        'view' => [
            'items' => [
                'new' => 'Nowy wpis',
                'breadcrumb_label' => 'Wpisy',
                'return' => 'Powrót do listy wpisów',
                'creating' => 'Tworzenie wpisu...',
                'delete_confirmation' => 'Czy na pewno usunąć ten wpis?'
            ],
            'categories' => [
                'new' => 'Nowa kategoria',
                'breadcrumb_label' => 'Kategorie',
                'return' => 'Powrót do listy kategorii',
                'creating' => 'Tworzenie kategorii...',
                'delete_confirmation' => 'Czy na pewno usunąć tą kategorię?'
            ]
        ],
        'list' => [
            'items' => 'Zarządzaj wpisami',
            'categories' => 'Zarządzaj kategoriami'
        ],
        'form' => [
            'items' => [
                'title' => 'Wpis',
                'create' => 'Stwórz wpis',
                'update' => 'Edytuj wpis',
                'flashCreate' => 'Wpis został pomyślnie stworzony',
                'flashUpdate' => 'Wpis został pomyślnie zaktualizowany',
                'flashDelete' => 'Wpis został pomyślnie usunięty'
            ],
            'categories' => [
                'title' => 'Kategoria',
                'create' => 'Stwórz kategorię',
                'update' => 'Zaktualizuj kategorię',
                'flashCreate' => 'Kategoria została pomyślnie stworzona',
                'flashUpdate' => 'Kategoria została pomyślnie zaktualizowana',
                'flashDelete' => 'Kategoria została pomyślnie usunięta'
            ]
        ],
    ],
    'columns' => [
        'item' => [
            'id' => 'ID',
            'title' => 'Tytuł',
            'category' => 'Kategoria'
        ],
        'category' => [
            'id' => 'ID',
            'name' => 'Nazwa',
            'description' => 'Opis'
        ]
    ],
    'fields' => [
        'item' => [
            'title' => 'Tytuł',
            'category' => 'Kategoria',
            'description' => 'Opis',
            'images' => 'Grafiki',
            'url' => 'URL'
        ],
        'category' => [
            'name' => 'Nazwa',
            'description' => 'Opis'
        ]
    ],
];
