<?php

use GateGem\Core\Builder\Form\FieldBuilder;
use GateGem\Core\Facades\GateConfig;
use GateGem\Core\Facades\Theme;

return GateConfig::Option('System')->setSort(0)->setFields([
    GateConfig::Field('page_title')
        ->setFieldType(FieldBuilder::Text)
        ->setTitle('Page Title'),
    GateConfig::Field('page_description')
        ->setFieldType(FieldBuilder::Quill)
        ->setTitle('Page Description'),
    GateConfig::Field('page_admin_theme')
        ->setFieldType(FieldBuilder::Dropdown)
        ->setDataDefault(true)
        ->setDataKey('key')
        ->setDataText('name')
        ->setFuncData(function () {
            return Theme::getData()->where(function ($item) {
                return $item->getValue('admin') == true;
            })->toArray();
        })
        ->setTitle('Theme Admin'),

    GateConfig::Field('page_site_theme')
        ->setFieldType(FieldBuilder::Dropdown)
        ->setDataDefault(true)
        ->setDataKey('key')
        ->setDataText('name')
        ->setFuncData(function () {
            return Theme::getData()->where(function ($item) {
                return !($item->getValue('admin') == true);
            })->toArray();
        })
        ->setTitle('Theme Site'),
]);
