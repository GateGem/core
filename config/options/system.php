<?php

use LaraIO\Core\Builder\Form\FieldBuilder;

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
    ]
];
