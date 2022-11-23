<?php

use LaraIO\Core\Builder\Form\FieldBuilder;
use LaraIO\Core\Facades\Theme;

return [
    'sort' => 0,
    'icon' => '',
    'title' => 'System',
    'fields' => [
        [
            'field' => 'page_title',
            'fieldType' => FieldBuilder::Text,
            'title' => 'Page Title',
        ],
        [
            'field' => 'page_description',
            'fieldType' => FieldBuilder::Textarea,
            'title' => 'Page Description',
        ],
        [
            'field' => 'page_admin_theme',
            'fieldType' => FieldBuilder::Dropdown,
            'fieldKey' => 'key',
            'fieldText' => 'name',
            'funcData' => function () {
                return Theme::getData()->toArray();
            },
            'title' => 'Theme Admin',
        ]
    ]
];
