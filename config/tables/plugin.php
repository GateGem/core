<?php

use GateGem\Core\Builder\Form\FieldBuilder;
use GateGem\Core\Facades\Core;
use GateGem\Core\Facades\GateConfig;
use GateGem\Core\Facades\Plugin;
use GateGem\Core\Support\Config\FieldConfig;

return GateConfig::NewItem()
    ->setFuncData(function () {
        return Plugin::getData();
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
        GateConfig::Field('name')->setTitle('core::tables.plugin.field.name')->setType(FieldBuilder::Text)->setKeyLayout('row1_1'),
        GateConfig::Field('key')->setTitle('core::tables.plugin.field.key')->setType(FieldBuilder::Text)->setKeyLayout('row1_2'),
        GateConfig::Field('description')->setTitle('core::tables.plugin.field.description')->setType(FieldBuilder::Text)->setKeyLayout('row1_1'),
        GateConfig::FieldStatus('status', 'plugin','key')
            ->setKeyLayout('row1_1'),
    ]);
