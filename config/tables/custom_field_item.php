<?php

use GateGem\Core\Builder\Form\FieldBuilder;
use GateGem\Core\Facades\GateConfig;
use GateGem\Core\Livewire\Modal;
use GateGem\Core\Support\Config\ButtonConfig;

return GateConfig::NewItem()
    ->setModel(\GateGem\Core\Models\CustomFieldItem::class)
    ->setFuncQuery(function ($query, $request, $param) {
        $query = $query->where('group_id', $param['group_id'])->orderBy('sort');
        return $query;
    })
    ->setButtonAppend([])
    ->setForm(GateConfig::Form()->setSize(Modal::ExtraLarge))
    ->setFuncDataChangeEvent(function ($param, $commponent, $request) {
        // if (isset($param['list_key'])) {
        //     remove_cache_list($param['list_key']);
        // } else {
        //     remove_cache_list($commponent->key);
        // }
    })
    ->setFields([
        GateConfig::Field('key')
            ->setTitle('core::tables.custom_field_item.field.key')
            ->hideEdit()
            ->disableEdit(),
        GateConfig::Field('title')
            ->setTitle('core::tables.custom_field_item.field.title'),
        GateConfig::Field('format')
            ->setTitle('core::tables.custom_field_item.field.format'),
        GateConfig::Field('list_key')
            ->setTitle('core::tables.custom_field_item.field.list_key'),
        GateConfig::Field('list_data')
            ->setTitle('core::tables.custom_field_item.field.list_data'),
        GateConfig::Field('type')
            ->setListKey('Custom_Field_Type')
            ->setTitle('core::tables.custom_field_item.field.type'),
        GateConfig::Field('placeholder')
            ->setTitle('core::tables.custom_field_item.field.placeholder'),
        GateConfig::Field('prepend')
            ->setTitle('core::tables.custom_field_item.field.prepend'),
        GateConfig::Field('append')
            ->setTitle('core::tables.custom_field_item.field.append'),
        GateConfig::Field('default')
            ->setTitle('core::tables.custom_field_item.field.default'),
        GateConfig::Field('character_limit')
            ->setTitle('core::tables.custom_field_item.field.character_limit'),
        GateConfig::Field('required')
            ->setTitle('core::tables.custom_field_item.field.required'),
        GateConfig::Field('status')
            ->setTitle('core::tables.custom_field_item.field.status'),
        GateConfig::FieldStatus('status', 'custom_field_item')
            ->setKeyLayout('row1_1'),
    ]);
