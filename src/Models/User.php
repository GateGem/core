<?php

namespace LaraPlatform\Core\Models;

use App\Models\User as Authenticatable;
use LaraPlatform\Core\Traits\WithPermission;
use LaraPlatform\Core\Traits\WithSlug;
use Illuminate\Support\Facades\Hash;
use LaraPlatform\Core\Supports\Core;

class User extends Authenticatable
{
    use WithPermission, WithSlug;
    public $FieldSlug = "name";
    protected $fillable = ["*"];
    public function isSuperAdmin(): bool
    {
        return $this->hasRole(Core::RoleAdmin());
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
