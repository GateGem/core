<?php

namespace GateGem\Core\Traits;


trait WithScopeQuery
{
    public function scopeStatus($query, $flg = true)
    {
        return $query->where('is_status', $flg);
    }
    public function scopeActive($query)
    {
        return $query->status(true);
    }
    public function scopeLock($query)
    {
        return $query->status(false);
    }
}
