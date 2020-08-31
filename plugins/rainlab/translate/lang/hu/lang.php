<?php

return [
    'plugin' => [
        'name' => 'Fordítás',
        'description' => 'Többnyelvű weboldal létrehozását teszi lehetővé.',
        'tab' => 'Fordítás',
        'manage_locales' => 'Nyelvek kezelése',
        'manage_messages' => 'Szövegek fordítása'
    ],
    'locale_picker' => [
        'component_name' => 'Nyelvi választó',
        'component_description' => 'Legördülő menüt jelenít meg a nyelv kiválasztásához.'
    ],
    'alternate_hreflang' => [
        'component_name' => 'Nyelvi oldalak',
        'component_description' => 'A hreflang HTML meta sorok generálása a keresők számára.'
    ],
    'locale' => [
        'title' => 'Nyelvek',
        'update_title' => 'Nyelv frissítése',
        'create_title' => 'Nyelv hozzáadása',
        'select_label' => 'Nyelv választása',
        'default_suffix' => 'alapértelmezett',
        'unset_default' => 'Már a(z) ":locale" nyelv az alapértelmezett, így nem használható alapértelmezettként.',
        'delete_default' => 'A(z) ":locale" nyelv az alapértelmezett, így nem törölhető.',
        'disabled_default' => 'A(z) ":locale" nyelv letiltott, így nem állítható be alapértelmezettként.',
        'name' => 'Név',
        'code' => 'Kód',
        'is_default' => 'Alapértelmezett',
        'is_default_help' => 'Az alapértelmezett nyelv a fordítás előtti tartalmat képviseli.',
        'is_enabled' => 'Engedélyezve',
        'is_enabled_help' => 'A letiltott nyelvek nem lesznek elérhetőek a látogatói oldalon.',
        'not_available_help' => 'Nincsenek más beállított nyelvek.',
        'hint_locales' => 'Itt hozhat létre új nyelveket a látogatói oldal tartalmának lefordításához. Az alapértelmezett nyelv képviseli a fordítás előtti tartalmat.',
        'reorder_title' => 'Rendezés',
        'sort_order' => 'Sorrend'
    ],
    'messages' => [
        'title' => 'Szövegek',
        'description' => 'Nyelvi változatok menedzselése.',
        'clear_cache_link' => 'Gyorsítótár kiürítése',
        'clear_cache_loading' => 'A weboldal gyorsítótár kiürítése...',
        'clear_cache_success' => 'Sikerült a weboldal gyorsítótár kiürítése!',
        'clear_cache_hint' => 'Kattintson a <strong>Gyorsítótár kiürítése</strong> gombra, hogy biztosan láthatóvá váljanak a beírt módosítások a látogatói oldalon is.',
        'scan_messages_link' => 'Szövegek keresése',
        'scan_messages_begin_scan' => 'Keresés indítása',
        'scan_messages_loading' => 'Új szövegek keresése...',
        'scan_messages_success' => 'Sikerült a szövegek beolvasása!',
        'scan_messages_hint' => 'A <strong>Szövegek keresése</strong> gombra kattintva pedig beolvashatja a lefordítandó szövegeket.',
        'scan_messages_process' => 'A folyamat megkisérli beolvasni az aktív témában lévő lefordítandó szövegeket.',
        'scan_messages_process_limitations' => 'Néhány szöveg nem biztos, hogy azonnal meg fog jelenni a listában.',
        'scan_messages_purge_label' => 'Szövegek törlése a művelet előtt',
        'scan_messages_purge_help' => 'Amennyiben bejelöli, úgy minden szöveg törlésre kerül a beolvasást megelőzően.',
        'scan_messages_purge_confirm' => 'Biztos, hogy töröljük az összes szöveget?',
        'hint_translate' => 'Itt fordíthatja le a látogatók által elérhető oldalon megjelenő szövegeket. A beírt változtatások automatikusan mentésre kerülnek.',
        'hide_translated' => 'Lefordítottak elrejtése',
        'export_messages_link' => 'Szövegek exportálása',
        'import_messages_link' => 'Szövegek importálása'
    ]
];
