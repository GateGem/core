<?php

use GateGem\Core\Builder\Form\FieldBuilder;
use GateGem\Core\Facades\GateConfig;

return GateConfig::Option('Auth')->setSort(1)->setFields([
    GateConfig::Field('page_message_login_title')
        ->setType(FieldBuilder::Text)
        ->setTitle('Login:Message Title'),
    GateConfig::Field('page_message_login_content')
        ->setType(FieldBuilder::Textarea)
        ->setTitle('Login:Message Content'),
    GateConfig::Field('page_message_register_title')
        ->setType(FieldBuilder::Text)
        ->setTitle('Register:Message Title'),
    GateConfig::Field('page_message_register_content')
        ->setType(FieldBuilder::Textarea)
        ->setTitle('Register:Message Content'),
    GateConfig::Field('login_token_param')
        ->setType(FieldBuilder::Text)
        ->setTitle('Login:Token Param'),
    GateConfig::Field('login_token_value')
        ->setType(FieldBuilder::Text)
        ->setTitle('Login:Token Value'),
]);
