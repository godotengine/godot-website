<?php

return [
    'plugin' => [
        'name' => 'Překlady',
        'description' => 'Aktivuje vícejazyčné stránky a překlady.',
        'tab' => 'Překlad',
        'manage_locales' => 'Správa jazyků',
        'manage_messages' => 'Správa překladů'
    ],
    'locale_picker' => [
        'component_name' => 'Výběr jazyka',
        'component_description' => 'Zobrazí možnost výberu jazyka ve stránkách.',
    ],
    'locale' => [
        'title' => 'Správa jazyků',
        'update_title' => 'Upravit jazyk',
        'create_title' => 'Přidat jazyk',
        'select_label' => 'Výběr jazyka',
        'default_suffix' => 'výchozí',
        'unset_default' => '":locale" je již výchozí a nemůže být odnastavena. Zkuste nastavit jiný jazyk jako výchozí.',
        'disabled_default' => '":locale" je neaktivní, takže nemůže být nastavený jako výchozí.',
        'name' => 'Název',
        'code' => 'Kód',
        'is_default' => 'Výchozí',
        'is_default_help' => 'Výchozí jazyk je jazyk webových stránek před překladem.',
        'is_enabled' => 'Aktivní',
        'is_enabled_help' => 'Neaktivní jazyky nepůjdou vybrat na webových stránkách.',
        'not_available_help' => 'Nemáte nastavené žádné jiné jazyky.',
        'hint_locales' => 'Zde můžete přidat nový jazyk pro překlad webových stránek. Výchozí jazyk reprezentuje obsah stránek ještě před překladem.',
    ],
    'messages' => [
        'title' => 'Překlad textů',
        'description' => 'Upravit text',
        'clear_cache_link' => 'Vymazat cache',
        'clear_cache_loading' => 'Mazání aplikační cache...',
        'clear_cache_success' => 'Aplikační cache úspěšně vymazána!',
        'clear_cache_hint' => 'Možná bude potřeba kliknout na <strong>Vymazat cache</strong>, aby se změny projevily na webobých stránkách.',
        'scan_messages_link' => 'Najít texty k překladu',
        'scan_messages_loading' => 'Hledání textů k překladu...',
        'scan_messages_success' => 'Prohledávání šablon pro získání textů k překladu úspěšně dokončeno!',
        'scan_messages_hint' => 'Kliknutím na <strong>Najít texty k překladu</strong> zkontroluje soubory aktivních témat a najde texty k překladu.',
        'hint_translate' => 'Zde můžete přeložit texty použité na webových stránkách. Pole budou automaticky uložena.',
        'hide_translated' => 'Schovat přeložené',
    ],
];
