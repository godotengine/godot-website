<?php

return [
    'plugin' => [
        'name' => 'Portfolio',
        'description' => 'Een plugin voor OctoberCMS om je laatste werk te tonen op je website.',
    ],
    'navigation' => [
        'label' => 'Portfolio',
        'sideMenu' => [
            'items' => 'Items',
            'categories' => 'Categorieën',
            'tags' => 'Tags'
        ]
    ],
    'permissions' => [
        'tab' => 'Portfolio',
        'manage' => 'Beheer portfolio'
    ],
    'components' => [
        'portfolio' => [
            'name' => 'Portfolio',
            'description' => 'Maak een lijst van portfolio\'s.',
            'properties' => [
                'category' => [
                    'title' => 'Categorie',
                    'placeholder' => 'Selecteer categorie',
                    'all' => 'Allemaal'
                ],
                'selectedTag' => [
                    'title' => 'Geselecteerde tag',
                    'description' => 'Verander deze waarde afhankelijk van de gebruikte identifier in de URL van deze pagina. Zie ook de handleiding van deze plugin.'
                ],
                'pageNumber' => [
                    'title' => 'Pagina nummer',
                    'description' => 'Dit wordt gebruikt om te bepalen op welke pagina de gebruiker zich bevind.'
                ],
                'itemsPerPage' => [
                    'title' => 'Items per pagina',
                    'validationMessage' => 'Het aantal items per pagina heeft een ongeldig formaat.'
                ],
                'order' => [
                    'title' => 'Volgorde',
                    'placeholder' => 'Selecteer volgorde',
                    'ascending' => 'Oplopend',
                    'descending' => 'Aflopend'
                ],
                'group' => [
                    'advanced' => 'Geavanceerd'
                ]
            ]
        ],
    ],
    'controller' => [
        'view' => [
            'items' => [
                'new' => 'Nieuw item',
                'breadcrumb_label' => 'Items',
                'return' => 'Terug naar de item lijst',
                'creating' => 'Aanmaken van item...',
                'delete_confirmation' => 'Weet je zeker dat je dit item wilt verwijderen?'
            ],
            'categories' => [
                'new' => 'Nieuwe categorie',
                'breadcrumb_label' => 'Categorieën',
                'return' => 'Terug naar de categorieën lijst',
                'creating' => 'Aanmaken van categorie...',
                'delete_confirmation' => 'Weet je zeker dat je deze categorie wilt verwijderen?'
            ],
            'tags' => [
                'new' => 'Nieuwe tag',
                'breadcrumb_label' => 'Tags',
                'return' => 'Terug naar het tags overzicht',
                'creating' => 'Aanmaken van tag...',
                'delete_confirmation' => 'Weet je zeker dat je deze tag wilt verwijderen?'
            ]
        ],
        'list' => [
            'items' => 'Items beheren',
            'categories' => 'Categorieën beheren',
            'tags' => 'Tags beheren'
        ],
        'form' => [
            'items' => [
                'title' => 'Item',
                'create' => 'Item aanmaken',
                'update' => 'Item wijzigen',
                'flashCreate' => 'Het item is aangemaakt',
                'flashUpdate' => 'Het item is gewijzigd',
                'flashDelete' => 'Het item is verwijderd'
            ],
            'categories' => [
                'title' => 'Categorie',
                'create' => 'Categorie aanmaken',
                'update' => 'Categorie wijzigen',
                'flashCreate' => 'De categorie is aangemaakt',
                'flashUpdate' => 'De categorie is geupdate',
                'flashDelete' => 'De categorie is verwijderd'
            ],
            'tags' => [
                'title' => 'Tags',
                'create' => 'Tag aanmaken',
                'update' => 'Tag wijzigen',
                'flashCreate' => 'De tag is aangemaakt',
                'flashUpdate' => 'De tag is geupdate',
                'flashDelete' => 'De tag is verwijderd'
            ]
        ],
    ],
    'columns' => [
        'item' => [
            'id' => 'ID',
            'title' => 'Titel',
            'category' => 'Categorie'
        ],
        'category' => [
            'id' => 'ID',
            'name' => 'Naam',
            'description' => 'Beschrijving'
        ],
        'tag' => [
            'id' => 'ID',
            'name' => 'Naam',
            'items' => 'Items met deze tag'
        ]
    ],
    'fields' => [
        'item' => [
            'title' => 'Titel',
            'category' => 'Categorie',
            'description' => 'Beschrijving',
            'images' => 'Afbeeldingen',
            'url' => 'URL'
        ],
        'category' => [
            'name' => 'Naam',
            'description' => 'Beschrijving'
        ],
        'tag' => [
            'name' => 'Naam',
            'items' => 'Items',
            'notavailable' => 'No items available'
        ]
    ],
];
