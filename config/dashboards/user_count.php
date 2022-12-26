<?php

use GateGem\Core\Builder\Form\FieldBuilder;
use GateGem\Core\Facades\GateConfig;
use GateGem\Core\Models\User;

return GateConfig::Widget('core::dashboard.user.title')
   // ->setPoll('.750ms')
    ->setColumn(FieldBuilder::Col3)
    ->setFuncData(function () {
        return User::count();
    })
    ->setClass('border-primary bg-primary text-white')
    ->setSort(0)
    ->setIcon('bi bi-people');
