<?php

return [
    'plugin' => [
        'name' => 'JWTAuth',
        'description' => 'JSON Web Token Authentication.',
    ],
    'permissions' => [
        'settings' => 'Manage JWTAuth',
    ],
    'settings' => [
        'menu_label' => 'JWTAuth',
        'menu_description' => 'Configure the JWTAuth',
        'tabs' => [
            'urls' => 'URL Settings',
            'extras' => 'Authorization Settings'
        ],
        'fields' => [
            'secret' => [
                'label' => 'JWT Secret',
                'comment' => "It's used to generate your token. Used only for HS256, HS384 & HS512 algorithms."
            ],
            'keys_public' => [
                'label' => 'Public key',
                'comment' => 'A path or resource to your public key.'
            ],
            'keys_private' => [
                'label' => 'Private key',
                'comment' => 'A path or resource to your private key.'
            ],
            'keys_passphrase' => [
                'label' => 'Passphrase',
                'comment' => 'The passphrase for your private key.'
            ],
            'ttl' => [
                'label' => 'Time to live',
                'comment' => 'Specify the length of time (in minutes) that the token will be valid for.'
            ],
            'refresh_ttl' => [
                'label' => 'Refresh time to live',
                'comment' => 'Specify the length of time (in minutes) that the token can be refreshed within.'
            ],
            'algo' => [
                'label' => 'Hashing algorithm',
                'comment' => 'Specify the hashing algorithm that will be used to sign the token.'
            ],
            'required_claims' => [
                'label' => 'Required Claims',
                'comment' => 'Specify the required claims that must exist in any token.'
            ],
            'persistent_claims' => [
                'label' => 'Persistent Claims',
                'comment' => 'Specify the claim keys to be persisted when refreshing a token.'
            ],
            'lock_subject' => [
                'label' => 'Lock subject',
                'comment' => 'This will determine whether a `prv` claim is automatically added to the token.'
            ],
            'leeway' => [
                'label' => 'Leeway',
                'comment' => 'This property gives the jwt timestamp claims some "leeway".'
            ],
            'blacklist_enabled' => [
                'label' => 'Enable Blacklist',
                'comment' => 'In order to invalidate tokens, you must have the blacklist enabled.'
            ],
            'blacklist_grace_period' => [
                'label' => 'Blacklist Grace Period',
                'comment' => 'Set grace period in seconds to prevent parallel request failure.'
            ],
            'decrypt_cookies' => [
                'label' => 'Encrypt the cookies',
                'comment' => 'Switch it off if you want to decrypt cookies.'
            ],
            'help_urls' => [
                'title' => 'READ IT FIRST!',
                'content' => "
                    <p>There is two ways to configure these URLs, and It'll depend of your application structure.</p>

                    <p><strong>Same domain</strong>: In this case you just need to inform the URI, 
                    and the system will considering that the base url is the same that your 
                    OctoberCMS installation.<p>

                    <p><strong>External domain</strong>: If your OctoberCMS and your front-end application 
                    are hosted in different domain you need to specify the full URL.</p>

                    <p>Also is important to remember that the both URLs must have the parameter 
                    <i>{code}</i> that will be replaced for the <i>activation code</i> or 
                    the <i>reset code</i> automatically.</p>
                "
            ],
            'activation_url' => [
                'label' => 'Account activation',
                'comment' => ''
            ],
            'reset_password_url' => [
                'label' => 'Password reset',
                'comment' => ''
            ]
        ]
    ]
];
