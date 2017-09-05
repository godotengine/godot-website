<?php

return [
    'plugin' => [
        'name' => 'Blog',
        'description' => 'Eine robuste Blog Plattform.'
    ],
    'blog' => [
        'menu_label' => 'Blog',
        'menu_description' => 'Blog Artikel bearbeiten',
        'posts' => 'Artikel',
        'create_post' => 'Blog Artikel',
        'categories' => 'Kategorien',
        'create_category' => 'Blog Kategorie',
        'tab' => 'Blog',
        'access_posts' => 'Blog Artikel verwalten',
        'access_categories' => 'Blog Kategorien verwalten',
        'access_other_posts' => 'Blog Artikel anderer Benutzer verwalten',
        'delete_confirm' => 'Bist du sicher?',
        'chart_published' => 'Veröffentlicht',
        'chart_drafts' => 'Entwurf',
        'chart_total' => 'Gesamt'
    ],
    'posts' => [
        'list_title' => 'Blog Artikel verwalten',
        'filter_category' => 'Kategorie',
        'filter_published' => 'Veröffentlichte ausblenden',
        'new_post' => 'Neuer Artikel'
    ],
    'post' => [
        'title' => 'Titel',
        'title_placeholder' => 'Neuer Titel',
        'slug' => 'Slug',
        'slug_placeholder' => 'new-post-slug',
        'categories' => 'Kategorien',
        'created' => 'Erstellt',
        'updated' => 'Aktualisiert',
        'published' => 'Veröffentlicht',
        'published_validation' => 'Bitte gebe das Datum der Veröffentlichung an',
        'tab_edit' => 'Bearbeiten',
        'tab_categories' => 'Kategorien',
        'categories_comment' => 'Wähle die zugehörigen Kategorien',
        'categories_placeholder' => 'Es existieren keine Kategorien. Bitte lege zuerst Kategorien an!',
        'tab_manage' => 'Verwalten',
        'published_on' => 'Veröffentlicht am',
        'excerpt' => 'Textauszug',
        'featured_images' => 'Zugehörige Bilder',
        'delete_confirm' => 'Möchtest du diesen Post wirklich löschen?',
        'close_confirm' => 'Der Artikel ist noch nicht gespeichert.',
        'return_to_posts' => 'Zurück zur Artikel-Übersicht'
    ],
    'categories' => [
        'list_title' => 'Blog Kategorien verwalten',
        'new_category' => 'Neue Kategorie',
        'uncategorized' => 'Allgemein'
    ],
    'category' => [
        'name' => 'Name',
        'name_placeholder' => 'Neuer Kategorie Name',
        'slug' => 'Slug',
        'slug_placeholder' => 'new-category-slug',
        'posts' => 'Posts',
        'delete_confirm' => 'Möchtest du die Kategorie wirklich löschen?',
        'return_to_categories' => 'Zurück zur Kategorie-Übersicht.'
    ],
    'settings' => [
        'category_title' => 'Blog Kategorie-Übersicht',
        'category_description' => 'Zeigt eine Blog Kategorien-Übersicht.',
        'category_slug' => 'Slug param name',
        'category_slug_description' => 'Der URL-Routen-Parameter welcher verwendet wird um die aktuelle Kategorie zu bestimmen. Wird von der Standard-Komponente benötigt um die aktive Kategorie zu markieren.',
        'category_display_empty' => 'Leere Kategorien anzeigen',
        'category_display_empty_description' => 'Kategorien zeigen welche keine Artikel besitzen.',
        'category_page' => 'Kategorien Seite',
        'category_page_description' => 'Name der Kategorien-Seiten-Datei für die Kategorien Links. Wird von der Standard-Komponente benötigt.',
        'post_title' => 'Blog Artikel',
        'post_description' => 'Zeigt einen Blog Artikel auf der Seite.',
        'post_slug' => 'Slug Parameter Name',
        'post_slug_description' => 'Der URL-Routen-Parameter um den Post mittels "Slug" zu bestimmen.',
        'post_category' => 'Kategorien-Seite',
        'post_category_description' => 'Name der Kategorien-Seiten-Datei für Kategorie-Links.',
        'posts_title' => 'Blog Artikel-Übersicht',
        'posts_description' => 'Stellt eine Liste der neuesten Artikel auf der Seite dar.',
        'posts_pagination' => 'Blättern Parameter-Name',
        'posts_pagination_description' => 'Der erwartete Parameter-Name welcher für Seiten verwendet wird.',
        'posts_filter' => 'Kategorien-Filter',
        'posts_filter_description' => 'Bitte gebe ein Kategorien-Slug oder URL-Parameter an, mittels den die Artikel gefiltert werden. Wenn der Wert leer ist, werden alle Artikel angezeigt.',
        'posts_per_page' => 'Artikel pro Seite',
        'posts_per_page_validation' => 'Ungültiger "Artikel pro Seiten" Wert',
        'posts_no_posts' => 'Keine Artikel Nachricht',
        'posts_no_posts_description' => 'Nachricht welche dargestellt wird wenn keine Artikel vorhanden sind. Dieser Wert wird von der Standard-Komponente verwendet.',
        'posts_order' => 'Artikel Sortierung',
        'posts_order_description' => 'Attribute nach welchem Artikel sortiert werden.',
        'posts_category' => 'Kategorien-Seite',
        'posts_category_description' => 'Name der Kategorien-Seiten-Datei für "Veröffentlicht in" Kategorien-Links. Dieser Wert von der Standard-Komponente verwendet.',
        'posts_post' => 'Artikel Seite',
        'posts_post_description' => 'Name der Artikel-Seiten-Datei für die "Erfahre mehr" Links. Dieser Wert für von der Standard-Komponente verwendet.'
    ]
];
