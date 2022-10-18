<?php

namespace LaraPlatform\Core\Supports;

class Core
{
    public static function adminPrefix()
    {
        return config('admin:web.admin', '/admincp');
    }
}
