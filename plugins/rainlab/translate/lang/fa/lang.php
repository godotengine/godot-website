<?php

return [
    'plugin' => [
        'name' => 'مترجم',
        'description' => 'فعال سازی وب سایت چند زبانه',
        'tab' => 'ترجمه',
        'manage_locales' => 'مدیریت مناطق',
        'manage_messages' => 'مدیریت پیغام ها'
    ],
    'locale_picker' => [
        'component_name' => 'انتخابگر منطقه',
        'component_description' => 'نمایش انتخابگر کشویی جهت انتخاب زبان.',
    ],
    'locale' => [
        'title' => 'مدیریت زبان ها',
        'update_title' => 'به روز رسانی زبان',
        'create_title' => 'ایجاد زبان',
        'select_label' => 'انتخاب زبان',
        'default_suffix' => 'پیشفرض',
        'unset_default' => '":locale" در حال حاظر پیشفرض می باشد و نمیتوانید آن را خارج کنید.',
        'disabled_default' => '":locale" غیر فعال می باشد و نمیتوانید آن را پیشفرض قرار دهید.',
        'name' => 'نام',
        'code' => 'کد یکتا',
        'is_default' => 'پیشفرض',
        'is_default_help' => 'زبان پیشفرضی که داده ها قبل از ترجمه به آن زبان وارد می شوند',
        'is_enabled' => 'فعال',
        'is_enabled_help' => 'زبان های غیر فعال در دسترس نخواهند بود.',
        'not_available_help' => 'زبان دیگری جهت نصب وجود ندارد.',
        'hint_locales' => 'زبان جدیدی را جهت ترجمه محتوی ایجاد نمایید.',
    ],
    'messages' => [
        'title' => 'ترجمه پیغام ها',
        'description' => 'به روز رسانی پیغام ها',
        'clear_cache_link' => 'پاکسازی حافظه کش',
        'clear_cache_loading' => 'در حال پاکسازی حافظه کش برنامه...',
        'clear_cache_success' => 'عملیات پاکسازی حافظه کش به اتمام رسید.',
        'clear_cache_hint' => 'جهت نمایش تغیرات در سایت نیاز است که شما بر رور <strong> پاکسازی حافظه کش </strong> کلیک نمایید.',
        'scan_messages_link' => 'جستجوی پیغام ها',
        'scan_messages_loading' => 'جستجوی پیغام های جدید...',
        'scan_messages_success' => 'جستجوی پیغام های جدید به اتمام رسید.',
        'scan_messages_hint' => 'جهت جستجو و نمایش پیغامهای جدیدی که باید ترجمه شوند بر روی <strong> جستجوی پیغام های جدید </strong> کلیک نمایید.',
        'hint_translate' => 'در این قسمت شما میتوانید پیغام ها را ترجمه نمایید. گزینه ها به صورت خودکار ذخیره میشوند.',
        'hide_translated' => 'مخفی سازی ترجمه شده ها',
    ],
];
