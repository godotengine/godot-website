<?php

return [
    'plugin' => [
        'name' => 'Tłumaczenia',
        'description' => 'Umożliwia tworzenie stron wielojęzycznych.',
        'tab' => 'Tłumaczenie',
        'manage_locales' => 'Zarządzaj językami',
        'manage_messages' => 'Zarządzaj treścią'
    ],
    'locale_picker' => [
        'component_name' => 'Lista języków',
        'component_description' => 'Wyświetla wybieralną listę języków strony.',
    ],
    'locale' => [
        'title' => 'Zarządzaj językami',
        'update_title' => 'Edytuj język',
        'create_title' => 'Stwórz język',
        'select_label' => 'Wybierz język',
        'default_suffix' => 'domyślny',
        'unset_default' => 'Język ":locale" jest już domyślny i nie można tego zmienić.',
        'disabled_default' => 'Język ":locale" jest wyłączony nie można zostać domyślnym.',
        'name' => 'Nazwa',
        'code' => 'Kod',
        'is_default' => 'Domyślny',
        'is_default_help' => 'Domyślny język to język treści strony przed tłumaczeniem.',
        'is_enabled' => 'Włączony',
        'is_enabled_help' => 'Wyłączone języki nie będą dostępne na stronie.',
        'not_available_help' => 'Nie skonfigurowano innych języków.',
        'hint_locales' => 'Stwórz nowe języki, na które chcesz tłumaczyć treść strony. Domyślny język to język treści strony przed tłumaczeniem. ',
    ],
    'messages' => [
        'title' => 'Tłumacz Treść',
        'description' => 'Tłumaczenie treści strony',
        'clear_cache_link' => 'Wyczyć Cache',
        'clear_cache_loading' => 'Czyszczenie cache...',
        'clear_cache_success' => 'Pomyślnie wyczyszczono cache aplikacji!',
        'clear_cache_hint' => 'Jeśli nie widzisz zmian na stronie, kliknij przycisk <strong>Wyczyść cache</strong>.',
        'scan_messages_link' => 'Skanuj treść',
        'scan_messages_loading' => 'Szukanie nowych pozycji...',
        'scan_messages_success' => 'Skanowanie plików motywu zakończyło się powodzeniem!',
        'scan_messages_hint' => 'Kliknięcie przycisku <strong>Skanuj treść</strong> rozpocznie skanowanie w poszukiwaniu nowych pozycji do przetłumaczenia.',
        'hint_translate' => 'Możesz tu przetłumaczyć treść strony. Pola zapisują się automatycznie.',
        'hide_translated' => 'Ukryj przetłumaczone',
    ],
];