<?php

namespace GateGem\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomFieldGroup extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'key',
        'title',
        'module_key',
        'model_key',
        'page_key',
        'data_key',
        'status',
        'sort'
    ];
    protected $casts = [];
    public function Items()
    {
        return $this->belongsTo(CustomFieldItem::class, 'group_id');
    }
}
