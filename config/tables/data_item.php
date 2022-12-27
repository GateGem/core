<?php

use GateGem\Core\Builder\Form\FieldBuilder;
use GateGem\Core\Facades\GateConfig;
use GateGem\Core\Livewire\Modal;
use GateGem\Core\Support\Config\ButtonConfig;

return GateConfig::NewItem()
    ->setModel(\GateGem\Core\Models\Role::class)
    ->setButtonAppend([
        GateConfig::Button('core::tables.role.button.permission')
            ->setIcon('<i class="bi bi-magic"></i>')
            ->setClass('btn btn-primary btn-sm')
            ->setPermission('core.role.permission')
            ->setDoComponent('core::page.permission.role', function ($id) {
                return "{'roleId':" . $id . "}";
            })
            ->setType(ButtonConfig::TYPE_UPDATE)
    ])
    ->setForm(GateConfig::Form()->setSize(Modal::Large))
    ->setFields([
        GateConfig::Field('slug')
            ->setTitle('core::tables.role.field.slug')
            ->disableEdit(),

        GateConfig::Field('name')
            ->setTitle('core::tables.role.field.name')
    ]);
