<?php

use GateGem\Core\Facades\GateConfig;
use GateGem\Core\Http\Action\LoadPermission;
use GateGem\Core\Livewire\Modal;
use GateGem\Core\Support\Config\ButtonConfig;

return GateConfig::NewItem()
    ->setModel(\GateGem\Core\Models\Permission::class)
    ->setButtonAppend([
        GateConfig::Button('core::tables.permission.button.load')
            ->setDoAction(LoadPermission::class)
            ->setIcon('<i class="bi bi-magic"></i>')
            ->setPermission('core.permission.load-permission')
            ->setType(ButtonConfig::TYPE_ADD)
    ])
    ->disableAdd()
    ->disableEdit()
    ->disableRemove()
   // ->setForm(GateConfig::Form()->setSize(Modal::ExtraLarge))
    ->setFields([
        GateConfig::Field('group')
            ->setTitle('core::tables.permission.field.group'),
        GateConfig::Field('slug')
            ->setTitle('core::tables.permission.field.slug'),
        GateConfig::Field('name')
            ->setTitle('core::tables.permission.field.name')
    ]);
