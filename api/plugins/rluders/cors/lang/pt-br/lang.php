<?php

return [
    'plugin' => [
        'name' => 'CORS',
        'description' => 'Cross-Origin Resource Sharing.',
    ],
    'permissions' => [
        'settings' => 'Gerenciar CORS',
    ],
    'settings' => [
        'menu_label' => 'CORS',
        'menu_description' => 'Configurar o CORS',
        'fields' => [
            'supportsCredentials' => [
                'label' => 'Suportar credenciais',
                'comment' => "Habilite para suportar credenciais entre domínios."
            ],
            'allowedOrigins' => [
                'label' => 'Origens permitidas',
                'comment' => 'Os domínios que podem realizar requisições para o seu site (use * para permitir todos).'
            ],
            'allowedHeaders' => [
                'label' => 'Headers permitidos',
                'comment' => 'Os headers que são suportados.'
            ],
            'allowedMethods' => [
                'label' => 'Métodos permitidos',
                'comment' => 'Os médotos HTTP que podem ser requisitados (use * para permitir todos).'
            ],
            'exposedHeaders' => [
                'label' => 'Headers expostos',
                'comment' => 'Os headers que podem ser expostos.'
            ],
            'maxAge' => [
                'label' => 'Idade máxima',
                'comment' => 'Define o valor para o header Access-Control-Max-Age.'
            ]
        ]
    ]
];
