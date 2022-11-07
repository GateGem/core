<?php

namespace LaraPlatform\Core\Supports;

class CoreManager
{
    public function RoleAdmin()
    {
        return config('core.permission.role', 'admin');
    }
    public function adminPrefix()
    {
        return config('core.web.admin', '/admincp');
    }
    public function MapPermissionModule($arr)
    {
        if (is_array($arr)) {
            if ($arr['name'] == 'core.table.slug') {
                return 'core.module.' . getValueByKey($arr, 'param.module', '');
            }
            return $arr['name'];
        }
        return $arr;
    }
}
