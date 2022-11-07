<?php

use LaraPlatform\Core\Builder\Form\FieldBuilder;

return [
    'icon' => '',
    'title' => 'Login Token',
    'fields'=>[
        [
            'field' => 'login_token_param',
            'fieldType' => FieldBuilder::Text,
            'title' => 'Login Token Param',
        ],
        [
            'field' => 'login_token_value',
            'fieldType' => FieldBuilder::Text,
            'title' => 'Login Token Value',
        ],
    ]
];
