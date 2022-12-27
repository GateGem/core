<?php

use GateGem\Core\Builder\Form\FieldBuilder;
use GateGem\Core\Facades\GateConfig;
use GateGem\Core\Livewire\Modal;
use GateGem\Core\Support\Config\ButtonConfig;

return GateConfig::NewItem()
    ->setModel(\GateGem\Core\Models\DataList::class)
    ->setButtonAppend([])
    ->setForm(GateConfig::Form()->setSize(Modal::Large))
    ->setFields([
        GateConfig::Field('key')
            ->setTitle('core::tables.datalist.field.key')
            ->disableEdit(),
        GateConfig::Field('title')
            ->setTitle('core::tables.datalist.field.title'),
        GateConfig::Field('content')
            ->setType(FieldBuilder::Quill)
            ->setTitle('core::tables.datalist.field.content'),
        GateConfig::FieldStatus('status', 'datalist')
            ->setKeyLayout('row1_1'),
        GateConfig::Field('item_default')
            ->setTitle('core::tables.datalist.field.item_default')
    ]);
