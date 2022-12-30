<?php

use GateGem\Core\Builder\Form\FieldBuilder;
use GateGem\Core\Facades\GateConfig;
use GateGem\Core\Livewire\Modal;
use GateGem\Core\Models\CustomFieldGroup;

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
            ->setFieldColumn(FieldBuilder::Col4)
            ->disableEdit(),
        GateConfig::Field('title')
            ->setFieldColumn(FieldBuilder::Col4)
            ->setTitle('core::tables.custom_field_item.field.title'),
        GateConfig::Field('format')
            ->hideView()
            ->setFieldColumn(FieldBuilder::Col4)
            ->setTitle('core::tables.custom_field_item.field.format'),
        GateConfig::Field('list_key')
            ->hideView()
            ->setFuncData(function () {
                return CustomFieldGroup::where('status', 1)->get();
            })
            ->setType(FieldBuilder::Dropdown)
            ->setDataDefault('')
            ->setDataTextDefault(true)
            ->setFieldColumn(FieldBuilder::Col4)
            ->setDataText('title')
            ->setTitle('core::tables.custom_field_item.field.list_key'),
        GateConfig::Field('list_data')
            ->hideView()
            ->setFieldColumn(FieldBuilder::Col4)
            ->setTitle('core::tables.custom_field_item.field.list_data'),
        GateConfig::Field('type')
            ->setListKey('Custom_Field_Type')
            ->setFieldColumn(FieldBuilder::Col4)
            ->setTitle('core::tables.custom_field_item.field.type'),
        GateConfig::Field('placeholder')
            ->hideView()
            ->setFieldColumn(FieldBuilder::Col4)
            ->setTitle('core::tables.custom_field_item.field.placeholder'),
        GateConfig::Field('prepend')
            ->hideView()
            ->setFieldColumn(FieldBuilder::Col4)
            ->setTitle('core::tables.custom_field_item.field.prepend'),
        GateConfig::Field('append')
            ->hideView()
            ->setFieldColumn(FieldBuilder::Col4)
            ->setTitle('core::tables.custom_field_item.field.append'),
        GateConfig::Field('default')
            ->hideView()
            ->setFieldColumn(FieldBuilder::Col4)
            ->setTitle('core::tables.custom_field_item.field.default'),
        GateConfig::Field('character_limit')
            ->hideView()
            ->setFieldColumn(FieldBuilder::Col4)
            ->setTitle('core::tables.custom_field_item.field.character_limit'),
        GateConfig::Field('required')
            ->setFieldColumn(FieldBuilder::Col2)
            ->setType(FieldBuilder::Check)
            ->setTitle('core::tables.custom_field_item.field.required'),
        GateConfig::FieldStatus('status', 'custom_field_item')
            ->setFieldColumn(FieldBuilder::Col2)
            ->setKeyLayout('row1_1'),
    ]);
