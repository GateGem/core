<?php

use GateGem\Core\Builder\Form\FieldBuilder;
use GateGem\Core\Facades\Core;
use GateGem\Core\Facades\GateConfig;
use GateGem\Core\Facades\Module;
use GateGem\Core\Support\Config\FieldConfig;

return GateConfig::NewItem()
    ->setFuncData(function () {
        return Module::getData();
    })
    ->setModelKey('key')
    ->hideAdd()
    ->hideEdit()
    ->hideRemove()
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
        GateConfig::Field('name')->setTitle('core::tables.module.field.name')->setFieldType(FieldBuilder::Text)->setKeyLayout('row1_1'),
        GateConfig::Field('key')->setTitle('core::tables.module.field.key')->setFieldType(FieldBuilder::Text)->setKeyLayout('row1_2'),
        GateConfig::Field('description')->setTitle('core::tables.module.field.description')->setFieldType(FieldBuilder::Text)->setKeyLayout('row1_1'),
        GateConfig::Field('status')->setTitle('core::tables.module.field.status')->setFieldType(FieldBuilder::Dropdown)->setKeyLayout('row1_1')
            ->setFuncData(function () {
                return collect([0, 1])->map(function ($item) {
                    return [
                        'id' => $item,
                        'text' => __('core::enums.status.' . $item)
                    ];
                });
            })
            ->setFuncCell(function ($value, $row, $column) {
                if (Core::checkPermission('core.module.change-status')) {
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
