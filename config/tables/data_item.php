<?php

use GateGem\Core\Builder\Form\FieldBuilder;
use GateGem\Core\Facades\GateConfig;
use GateGem\Core\Livewire\Modal;

return GateConfig::NewItem()
    ->setModel(\GateGem\Core\Models\DataItem::class)
    ->setFuncQuery(function ($query, $request, $param) {
        $query = $query->where('list_id', $param['list_id'])->orderBy('sort');
        return $query;
    })
    ->setButtonAppend([])
    ->setForm(GateConfig::Form()->setSize(Modal::ExtraLarge))
    ->setFuncDataChangeEvent(function ($param, $commponent, $request) {
        remove_cache_list($param['list_key']);
    })
    ->setFields([
        GateConfig::Field('list_id')
            ->setFuncDataBind(function ($isNew, $param, $commponent) {
                return $param['list_id'];
            }),
        GateConfig::Field('title')
            ->setTitle('core::tables.data_item.field.title')
            ->disableEdit(),
        GateConfig::Field('link')
            ->setTitle('core::tables.data_item.field.link'),
        GateConfig::Field('image')
            ->setTitle('core::tables.data_item.field.image'),
        GateConfig::Field('value')
            ->setTitle('core::tables.data_item.field.value'),
        GateConfig::Field('content_short')
            ->setType(FieldBuilder::Textarea)
            ->setTitle('core::tables.data_item.field.content_short'),
        GateConfig::Field('content')
            ->setType(FieldBuilder::Quill)
            ->setTitle('core::tables.data_item.field.content'),
        GateConfig::FieldStatus('status', 'data_item'),
        GateConfig::Field('sort')
            ->setDataDefault(0)
            ->setType(FieldBuilder::Number)
            ->setTitle('core::tables.data_item.field.sort'),
    ])->disableSort()->disableFilter();
