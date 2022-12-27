<?php

namespace GateGem\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomFieldItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'group_id',
        'key',
        'title',
        'format',
        'list_key',
        'list_data',
        'type',
        'default',
        'status',
        'sort'
    ];
    protected $casts = [];
    public function FieldGroup()
    {
        return $this->belongsTo(CustomFieldGroup::class, 'group_id');
    }
}
