<?php

/**
 * Translate Plugin Lang File
 * Carlos Gonzalez Gurrea
 * http://www.carlosgonzalezgurrea.es
 */

return [
    'plugin' => [
        'name' => 'Multilenguaje',
        'description' => 'Permite sitios web multilingües',
        'manage_locales' => 'Manage locales',
        'manage_messages' => 'Manage messages'
    ],
    'locale_picker' => [
        'component_name' => 'Selección de idioma',
        'component_description' => 'Muestra una lista desplegable para seleccionar un idioma para el usuario',
    ],
    'locale' => [
        'title' => 'Administrar idiomas',
        'update_title' => 'Actualizar idioma',
        'create_title' => 'Crear idioma',
        'select_label' => 'Seleccionar idioma',
        'default_suffix' => 'Defecto',
        'unset_default' => '": locale" ya está predeterminado y no puede ser nulo por defecto.',
        'disabled_default' => '":locale" esta desactivado y no puede ser idioma por defecto',
        'name' => 'Nombre',
        'code' => 'Código',
        'is_default' => 'Por defecto',
        'is_default_help' => 'El idioma por defecto con el que se representa el contenido antes de la traducción.',
        'is_enabled' => 'Habilitado',
        'is_enabled_help' => 'Los idiomas desactivados no estarán disponibles en el front-end',
        'not_available_help' => 'No hay otros idiomas establecidos.',
        'hint_locales' => 'Crear nuevos idiomas aquí para traducir el contenido de front-end. El idioma por defecto representa el contenido antes de que haya sido traducido.',
    ],
    'messages' => [
        'title' => 'Traducir mensajes',
		'description' => 'Editar mensajes',
        'clear_cache_link' => 'Limpiar cache',
        'clear_cache_loading' => 'Borrado de la memoria caché de aplicaciones ...',
        'clear_cache_success' => 'Se ha borrado la memoria cache dela aplicación con éxito',
        'clear_cache_hint' => 'Es posible que tenga que hacer clic en <strong> Borrar caché </ strong> para ver los cambios en el front-end.',
        'scan_messages_link' => 'Escanear mensajes',
        'scan_messages_loading' => 'Escaneando nuevos mensajes...',
        'scan_messages_success' => 'Escaneado de los archivos del tema completado!',
        'scan_messages_hint' => 'Al hacer click en Escanear comprobaremos los mensajes de </ strong> los archivos de los temas activos <strong> para localizar nuevos mensajes a traducir.',
        'hint_translate' => 'Aquí usted puede traducir los mensajes utilizados en el front-end, los campos se guardará automáticamente.',
        'hide_translated' => 'Ocultar traducción',
    ],
];