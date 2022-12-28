<?php

use GateGem\Core\Builder\Form\FieldBuilder;
use GateGem\Core\Facades\Core;
use GateGem\Core\Facades\GateConfig;
use GateGem\Core\Facades\Theme;
use GateGem\Core\Support\Config\FieldConfig;

return GateConfig::NewItem()
    ->setFuncData(function () {
        return Theme::getData()->where(function ($item) {
            if (isset($item['hide']) && $item['hide'] == true) return false;
            return true;
        })->toBase();
    })
    ->setModelKey('key')
    ->disableAdd()
    ->disableEdit()
    ->disableRemove()
    ->setForm(
        GateConfig::Form()
            ->setLayout([
                [
                    ['key' => 'row1_1', 'column' => FieldBuilder::Col6],
                    ['key' => 'row1_2', 'column' => FieldBuilder::Col6],
                ],
                [
                    ['key' => 'row2_1', 'column' => FieldBuilder::Col12],
                ]
            ])->setClass('p-1')
    )
    ->setFields([
        GateConfig::Field('name')->setTitle('core::tables.theme.field.name')->setType(FieldBuilder::Text)->setKeyLayout('row1_1'),
        GateConfig::Field('key')->setTitle('core::tables.theme.field.key')->setType(FieldBuilder::Text)->setKeyLayout('row1_2'),
        GateConfig::Field('description')->setTitle('core::tables.theme.field.description')->setType(FieldBuilder::Text)->setKeyLayout('row1_1'),
        GateConfig::Field('admin')->setTitle('core::tables.theme.field.admin')->setType(FieldBuilder::Text)->setKeyLayout('row1_1')
            ->setFuncCell(function ($value, $row, $column) {
                if ($value == 1) {
                    return 'Admin';
                }
                return 'Site';
            }),
        GateConfig::FieldStatus('status', 'theme','key')
            ->setKeyLayout('row1_1'),
    ]);
