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
        GateConfig::Field('status')->setTitle('core::tables.theme.field.status')->setType(FieldBuilder::Dropdown)->setKeyLayout('row1_1')
            ->setFuncData(function () {
                return collect([0, 1])->map(function ($item) {
                    return [
                        'id' => $item,
                        'name' => __('core::enums.status.' . $item)
                    ];
                });
            })
            ->setFuncCell(function ($value, $row, $column) {
                if (Core::checkPermission('core.theme.change-status')) {
                    if ($value == 1) {
                        return  GateConfig::Button('core::enums.status.1')
                            ->setClass('btn btn-primary btn-sm text-nowrap')
                            ->setDoChangeField("{'id':'" . $row['name'] . "','field':'" . $column[FieldConfig::FIELD] . "','value':0,'key':'key'}")
                            ->toHtml();
                    }
                    return  GateConfig::Button('core::enums.status.0')
                        ->setClass('btn btn-warning btn-sm text-nowrap')
                        ->setDoChangeField("{'id':'" . $row['name'] . "','field':'" . $column[FieldConfig::FIELD] . "','value':1,'key':'key'}")
                        ->toHtml();
                }

                if ($value == 1) {
                    return '<span class="bg-primary text-white p-2 rounded">' . __('core::enums.status.1') . '</span>';
                }
                return '<span class="bg-warning text-white p-2 rounded">' . __('core::enums.status.0') . '</span>';
            }),
    ]);
