<?php

use LaraPlatform\Core\Builder\Form\FieldBuilder;

return [
    'icon' => '',
    'title' => 'System',
    'fields'=>[
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
