<?php

namespace GateGem\Core\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use GateGem\Core\Traits\WithPermission;
use GateGem\Core\Traits\WithSlug;
use Illuminate\Support\Facades\Hash;
use GateGem\Core\Facades\Core;

class User extends Authenticatable
{
    use WithPermission, WithSlug;
    public $FieldSlug = "name";
    protected $fillable = ["*"];
    public function isActive()
    {
        return $this->status == 1;
    }
    public function isSuperAdmin(): bool
    {
        return $this->hasRole(Core::RoleAdmin());
    }
    public function isBlock()
    {
        return !$this->isActive();
    }
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            if (Hash::needsRehash($model->password)) {
                $model->password = Hash::make($model->password);
            }
        });
        self::updating(function ($model) {
            if ($model->password && Hash::needsRehash($model->password)) {
                $model->password = Hash::make($model->password);
            }
        });
    }
}
