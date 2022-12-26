<?php

use GateGem\Core\Builder\Form\FieldBuilder;
use GateGem\Core\Facades\GateConfig;
use GateGem\Core\Models\Role;

return GateConfig::Widget('core::dashboard.role.title')
    //->setPoll('.750ms')
    ->setColumn(FieldBuilder::Col3)
    ->setFuncData(function () {
        return Role::count();
    })
    ->setClass('border-success bg-success text-white')
    ->setSort(1)
    ->setIcon('bi bi-diagram-2-fill');
