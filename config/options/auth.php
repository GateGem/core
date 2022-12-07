<?php

use GateGem\Core\Builder\Form\FieldBuilder;
use GateGem\Core\Facades\Theme;

return [
    'sort' => 1,
    'icon' => '',
    'title' => 'Auth',
    'fields' => [
        [
            'field' => 'page_message_login_title',
            'fieldType' => FieldBuilder::Text,
            'title' => 'Login:Message Title',
        ],
        [
            'field' => 'page_message_login_content',
            'fieldType' => FieldBuilder::Textarea,
            'title' => 'Login:Message Content',
        ],
        [
            'field' => 'page_message_register_title',
            'fieldType' => FieldBuilder::Text,
            'title' => 'Register:Message Title',
        ],
        [
            'field' => 'page_message_register_content',
            'fieldType' => FieldBuilder::Textarea,
            'title' => 'Register:Message Content',
        ],
        [
            'field' => 'login_token_param',
            'fieldType' => FieldBuilder::Text,
            'title' => 'Login:Token Param',
        ],
        [
            'field' => 'login_token_value',
            'fieldType' => FieldBuilder::Text,
            'title' => 'Login:Token Value',
        ],
    ]
];
