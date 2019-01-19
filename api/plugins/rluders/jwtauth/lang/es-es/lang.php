<?php
return [
    'plugin' => [
        'name' => 'JWTAuth',
        'description' => 'Autentificación con Token Web JSON.',
    ],
    'permissions' => [
        'settings' => 'Ajustes de JWTAuth',
    ],
    'settings' => [
        'menu_label' => 'JWTAuth',
        'menu_description' => 'Configurar JWTAuth',
        'tabs' => [
            'urls' => 'Opciones de URL',
            'extras' => 'Opciones de autorización'
        ],
        'fields' => [
            'secret' => [
                'label' => 'JWT Secreto',
                'comment' => "Se utiliza para generar su token. Sólo se utiliza en los algoritmos HS256, HS384 y HS512."
            ],
            'keys_public' => [
                'label' => 'Llave pública',
                'comment' => 'Una dirección o archivo para su llave pública.'
            ],
            'keys_private' => [
                'label' => 'Llave privada',
                'comment' => 'Una dirección o archivo para su llave privada.'
            ],
            'keys_passphrase' => [
                'label' => 'Contraseña',
                'comment' => 'La contraseña para su llave privada.'
            ],
            'ttl' => [
                'label' => 'Tiempo de uso',
                'comment' => 'Especificar el tiempo (en minutos) durante el cual su token será válido.'
            ],
            'refresh_ttl' => [
                'label' => 'Actualizar tiempo de uso',
                'comment' => 'Especificar el tiempo (en minutos) tras el cual se actualizará su token.'
            ],
            'algo' => [
                'label' => 'Algoritmo de hashing',
                'comment' => 'Especificar el algoritmo de hashing para firmar el token.'
            ],
            'required_claims' => [
                'label' => 'Reclamaciones requeridas',
                'comment' => 'Especificar las reclamaciones requeridas que deben existir para cada token.'
            ],
            'persistent_claims' => [
                'label' => 'Reclamaciones persistentes',
                'comment' => 'Especificar que las llaves persistan tras actualizar un token.'
            ],
            'lock_subject' => [
                'label' => 'Bloquear sujeto',
                'comment' => 'Esto hará que una reclamación `prv` se añada automáticamente al token.'
            ],
            'leeway' => [
                'label' => 'Margen',
                'comment' => 'Esta opción da al jwt timestamp claims cierto "margen".'
            ],
            'blacklist_enabled' => [
                'label' => 'Activar lista negra',
                'comment' => 'Para anular tokens debe activar la lista negra primero.'
            ],
            'blacklist_grace_period' => [
                'label' => 'Tiempo de espera para lista negra',
                'comment' => 'Poner un tiempo de espera en segundos para evitar fallos de peticiones paralelas.'
            ],
            'decrypt_cookies' => [
                'label' => 'Encriptar cookies',
                'comment' => 'Apague esta opción si quiere desencriptar las cookies.'
            ],
            'help_urls' => [
                'title' => '¡LEE ESTO PRIMERO!',
                'content' => "
                    <p>Hay dos maneras de configurar estas URLs, y dependerá de tu estructura de aplicación.</p>
                    
                    <p><strong>Mismo dominio</strong>: En este caso sólo debes dar el URI, 
                    y el sistema considerará que la url base es la misma que tu
                    instalación OctoberCMS.<p>
                    
                    <p><strong>Dominio externo</strong>: Si OctoberCMS y tu aplicación front-end
                    se alojan en dominios diferentes debes especificar toda la URL.</p>
                    
                    <p>También recuerda que ambas URLs deben tener el parámetro 
                    <i>{code}</i> que se sustituirá por el <i>código de activación</i> o 
                    el <i>código de cambio</i> automáticamente.</p>
                "
            ],
            'activation_url' => [
                'label' => 'Activar cuenta',
                'comment' => ''
            ],
            'reset_password_url' => [
                'label' => 'Cambiar contraseña',
                'comment' => ''
            ]
        ]
    ]
];
