<?php

use GateGem\Core\Builder\Form\FieldBuilder;
use GateGem\Core\Facades\Theme;

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
            'optionDefault' => true,
            'funcData' => function () {
                return Theme::getData()->where(function ($item) {
                    return $item->getValue('admin') == true;
                })->toArray();
            },
            'title' => 'Theme Admin',
        ],
        [
            'field' => 'page_site_theme',
            'fieldType' => FieldBuilder::Dropdown,
            'fieldKey' => 'key',
            'fieldText' => 'name',
            'optionDefault' => true,
            'funcData' => function () {
                return Theme::getData()->where(function ($item) {
                    return !($item->getValue('admin') == true);
                })->toArray();
            },
            'title' => 'Theme Site',
        ]
    ]
];
