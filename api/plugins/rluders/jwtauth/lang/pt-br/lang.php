<?php

return [
    'plugin' => [
        'name' => 'JWTAuth',
        'description' => 'Autenticação com JSON Web Token.',
    ],
    'permissions' => [
        'settings' => 'Gerenciar JWTAuth',
    ],
    'settings' => [
        'menu_label' => 'JWTAuth',
        'menu_description' => 'Configure the JWTAuth',
        'fields' => [
            'secret' => [
                'label' => 'JWT Segredo',
                'comment' => 'É usado para gerar o seu token. Usado apenas para os algorítimos HS256, HS384 e HS512.'
            ],
            'keys_public' => [
                'label' => 'Chave pública',
                'comment' => 'Caminho ou recurso para sua chave pública.'
            ],
            'keys_private' => [
                'label' => 'Chave privada',
                'comment' => 'Caminho ou recurso para sua chave privada.'
            ],
            'keys_passphrase' => [
                'label' => 'Palavra-passe',
                'comment' => 'A palavra passe para sua chave privada.'
            ],
            'ttl' => [
                'label' => 'Tempo de vida',
                'comment' => 'Informe o tempo de vida (em minutos) que seu token será válido.'
            ],
            'refresh_ttl' => [
                'label' => 'Atualizar tempo de vida',
                'comment' => 'Informe o tempo (em minutos) que seu token deverá atualizado.'
            ],
            'algo' => [
                'label' => 'Algorítimo de Hashing',
                'comment' => 'Selecione o algorítimo de hashing que será utilizado para gerar seu token.'
            ],
            'required_claims' => [
                'label' => 'Reivindicações requeridas',
                'comment' => 'Informe as reivindiações requeridas que devem existir em qualquer token.'
            ],
            'persistent_claims' => [
                'label' => 'Reivindicações persistentes',
                'comment' => 'Informe as reivindicações que devem persistir quando seu token for atualizado.'
            ],
            'lock_subject' => [
                'label' => 'Travar sujeito',
                'comment' => 'Isso determinará se uma reivindicação `prv` é automaticamente adicionada ao token.'
            ],
            'leeway' => [
                'label' => 'Leeway',
                'comment' => 'Esta propriedade dá ao timestamp jwt uma certa margem.'
            ],
            'blacklist_enabled' => [
                'label' => 'Habilitar lista negra',
                'comment' => 'Para invalidar tokens, você deve ter a lista negra ativada.'
            ],
            'blacklist_grace_period' => [
                'label' => 'Período de carência da lista negra',
                'comment' => 'Defina o período de carência em segundos para evitar falha na solicitação paralela.'
            ],
            'decrypt_cookies' => [
                'label' => 'Criptografar os cookies',
                'comment' => 'Desligue-o se quiser descriptografar os cookies.'
            ]
        ]
    ]
];
