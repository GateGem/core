<?php

use GateGem\Core\Builder\Form\FieldBuilder;
use GateGem\Core\Facades\GateConfig;
use GateGem\Core\Facades\Theme;

return GateConfig::Option('System')->setSort(0)->setFields([
    GateConfig::Field('page_title')
        ->setType(FieldBuilder::Text)
        ->setTitle('Page Title'),
    GateConfig::Field('page_description')
        ->setType(FieldBuilder::Quill)
        ->setTitle('Page Description'),
    GateConfig::Field('page_admin_theme')
        ->setType(FieldBuilder::Dropdown)
        ->setDataDefault(true)
        ->setFieldColumn(FieldBuilder::Col6)
        ->setDataKey('key')
        ->setDataText('name')
        ->setFuncData(function () {
            return Theme::getData()->where(function ($item) {
                return $item->getValue('admin') == true;
            })->toArray();
        })
        ->setTitle('Theme Admin'),

    GateConfig::Field('page_site_theme')
        ->setType(FieldBuilder::Dropdown)
        ->setFieldColumn(FieldBuilder::Col6)
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
