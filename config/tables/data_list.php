<?php

use GateGem\Core\Builder\Form\FieldBuilder;
use GateGem\Core\Facades\GateConfig;
use GateGem\Core\Livewire\Modal;
use GateGem\Core\Support\Config\ButtonConfig;

return GateConfig::NewItem()
    ->setModel(\GateGem\Core\Models\DataList::class)
    ->setButtonAppend([
        GateConfig::Button('core::tables.data_list.button.list')
            ->setIcon('<i class="bi bi-magic"></i>')
            ->setClass('btn btn-primary btn-sm')
            // ->setPermission('core.role.permission')
            ->setDoComponent('core::table.index', function ($id) {
                return "{'roleId':" . $id . ",'module':'data_item'}";
            })
            ->setType(ButtonConfig::TYPE_UPDATE)
    ])
    ->setForm(GateConfig::Form()->setSize(Modal::Large))
    ->setFields([
        GateConfig::Field('key')
            ->setTitle('core::tables.data_list.field.key')
            ->hideEdit()
            ->disableEdit(),
        GateConfig::Field('title')
            ->setTitle('core::tables.data_list.field.title'),
        GateConfig::Field('content')
            ->setDataDefault('')
            ->setType(FieldBuilder::Quill)
            ->setTitle('core::tables.data_list.field.content'),
        GateConfig::FieldStatus('status', 'data_list')
            ->setKeyLayout('row1_1'),
        // GateConfig::Field('item_default')
        //     ->setTitle('core::tables.data_list.field.item_default')
    ]);
