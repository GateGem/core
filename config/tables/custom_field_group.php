<?php

use GateGem\Core\Builder\Form\FieldBuilder;
use GateGem\Core\Facades\GateConfig;
use GateGem\Core\Livewire\Modal;
use GateGem\Core\Support\Config\ButtonConfig;

return GateConfig::NewItem()
    ->setModel(\GateGem\Core\Models\CustomFieldGroup::class)
    ->setFuncExtendParam(function ($row) {
        return ",'custom_field_key':'" . $row['key'] . "'";
    })
    ->setButtonAppend([
        GateConfig::Button('core::tables.custom_field_group.button.list')
            ->setIcon('<i class="bi bi-magic"></i>')
            ->setClass('btn btn-primary btn-sm')
            // ->setPermission('core.role.permission')
            ->setDoComponent('core::table.index', function ($id, $row) {
                return "{'custom_field_key':'" . $row['key'] . "','group_id':" . $id . ",'module':'custom_field_item'}";
            })
            ->setType(ButtonConfig::TYPE_UPDATE)
    ])
    ->setFuncDataChangeEvent(function ($param, $commponent, $request) {
        // if (isset($param['list_key'])) {
        //     remove_cache_list($param['list_key']);
        // } else {
        //     remove_cache_list($commponent->key);
        // }
    })
    //->setEdit('core::custom-field.index')
    ->setForm(GateConfig::Form()->setSize(Modal::Large))
    ->setFields([
        GateConfig::Field('key')
            ->setTitle('core::tables.custom_field_group.field.key')
            ->hideEdit()
            ->disableEdit(),
        GateConfig::Field('title')
            ->setTitle('core::tables.custom_field_group.field.title'),
        GateConfig::FieldStatus('status', 'custom_field_group')
            ->setKeyLayout('row1_1'),
        // GateConfig::Field('item_default')
        //     ->setTitle('core::tables.custom_field_group.field.item_default')
    ]);
