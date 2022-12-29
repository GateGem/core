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
            ->setTitle('core::tables.data_list.field.key')
            ->hideEdit()
            ->disableEdit(),
        GateConfig::Field('title')
            ->setTitle('core::tables.data_list.field.title'),
        GateConfig::FieldStatus('status', 'data_list')
            ->setKeyLayout('row1_1'),
        // GateConfig::Field('item_default')
        //     ->setTitle('core::tables.data_list.field.item_default')
    ]);
