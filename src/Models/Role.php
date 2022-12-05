<?php

namespace GateGem\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use GateGem\Core\Traits\WithSlug;

class Role extends Model
{
    use HasFactory, WithSlug;
    public $FieldSlug = "name";

    protected $fillable = [
        'name',
        'slug'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_roles');
    }
}
