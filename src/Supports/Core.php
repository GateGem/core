<?php

namespace LaraPlatform\Core\Supports;

class Core
{
    public static function RoleAdmin(){
        return config('core:permission.role','admin');
    }
    public static function adminPrefix()
    {
        return config('core:web.admin', '/admincp');
    }
}
