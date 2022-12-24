<?php

use GateGem\Core\Builder\Form\FieldBuilder;
use GateGem\Core\Facades\Core;
use GateGem\Core\Facades\GateConfig;
use GateGem\Core\Livewire\Modal;
use GateGem\Core\Support\Config\ButtonConfig;

return GateConfig::NewItem()
    ->setModel(\GateGem\Core\Models\User::class)
    ->setButtonAppend([
        GateConfig::Button('core::tables.user.button.permission')
            ->setIcon('<i class="bi bi-magic"></i>')
            ->setClass('btn btn-primary btn-sm')
            ->setPermission('core.user.permission')
            ->setDoComponent('core::page.permission.user', function ($id) {
                return "{'userId':" . $id . "}";
            })
            ->setType(ButtonConfig::TYPE_UPDATE)
    ])
    ->setForm(
        GateConfig::Form()->setSize(Modal::ExtraLarge)
            ->setRule(function () {
                return [
                    'name' => ['required'],
                    'email' => ['required', 'email'],
                    'password' => ['required'],
                ];
            })
            ->setLayout([
                [
                    ['key' => 'row1_1', 'column' => FieldBuilder::Col6],
                    ['key' => 'row1_2', 'column' => FieldBuilder::Col6],
                ],
                [
                    ['key' => 'row2_1', 'column' => FieldBuilder::Col12],
                ]
            ])
    )
    ->setFields([
        GateConfig::Field('name')
            ->setTitle('core::tables.user.field.name')
            ->setKeyLayout('row1_1'),
        GateConfig::Field('avatar')
            ->setTitle('core::tables.user.field.avatar')
            ->setType(FieldBuilder::Image)
            ->setFolder('user')
            ->setKeyLayout('row1_1'),
        GateConfig::Field('email')
            ->hideView()
            ->setTitle('core::tables.user.field.email')
            ->setKeyLayout('row1_2'),
        GateConfig::Field('info')
            ->setTitle('core::tables.user.field.info')
            ->setType(FieldBuilder::Textarea)
            ->setKeyLayout('row2_1'),
        GateConfig::Field('password')
            ->hideView()
            ->hideEdit()
            ->setTitle('core::tables.user.field.password')
            ->setType(FieldBuilder::Password)
            ->setKeyLayout('row1_1'),
        GateConfig::Field('status')
            ->setDataDefault(0)
            ->setFuncData(function () {
                return collect([0, 1])->map(function ($item) {
                    return [
                        'id' => $item,
                        'name' => __('core::enums.status.' . $item)
                    ];
                });
            })
            ->setFuncCell(function ($value, $row, $column) {
                if (Core::checkPermission('core.user.change-status')) {
                    if ($value == 1) {
                        return  GateConfig::Button('core::enums.status.1')
                            ->setClass('btn btn-primary btn-sm text-nowrap')
                            ->setDoChangeField("{'id':" . $row['id'] . ",'field':'status','value':0,'key':'id'}")
                            ->toHtml();
                    }
                    return  GateConfig::Button('core::enums.status.0')
                        ->setClass('btn btn-warning btn-sm text-nowrap')
                        ->setDoChangeField("{'id':" . $row['id'] . ",'field':'status','value':1,'key':'id'}")
                        ->toHtml();
                }
                if ($value == 1) {
                    return __('core::enums.status.1');
                }
                return __('core::enums.status.0');
            })
            ->setTitle('core::tables.user.field.status')
            ->setType(FieldBuilder::Dropdown)
            ->setKeyLayout('row1_2')
    ]);
