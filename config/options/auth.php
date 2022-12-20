<?php

use GateGem\Core\Builder\Form\FieldBuilder;
use GateGem\Core\Facades\GateConfig;

return GateConfig::Option('Auth')->setSort(1)->setFields([
    GateConfig::Field('page_message_login_title')
        ->setFieldType(FieldBuilder::Text)
        ->setTitle('Login:Message Title'),
    GateConfig::Field('page_message_login_content')
        ->setFieldType(FieldBuilder::Textarea)
        ->setTitle('Login:Message Content'),
    GateConfig::Field('page_message_register_title')
        ->setFieldType(FieldBuilder::Text)
        ->setTitle('Register:Message Title'),
    GateConfig::Field('page_message_register_content')
        ->setFieldType(FieldBuilder::Textarea)
        ->setTitle('Register:Message Content'),
    GateConfig::Field('login_token_param')
        ->setFieldType(FieldBuilder::Text)
        ->setTitle('Login:Token Param'),
    GateConfig::Field('login_token_value')
        ->setFieldType(FieldBuilder::Text)
        ->setTitle('Login:Token Value'),
]);
