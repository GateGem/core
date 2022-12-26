<?php

use GateGem\Core\Builder\Form\FieldBuilder;
use GateGem\Core\Facades\GateConfig;
use GateGem\Core\Models\Permission;

return GateConfig::Widget('Permission')
   // ->setPoll('.750ms')
    ->setColumn(FieldBuilder::Col3)
    ->setFuncData(function () {
        return Permission::count();
    })
    ->setClass('border-danger bg-danger text-white')
    ->setIcon('bi bi-shield-fill-check')
    ->Disable();
