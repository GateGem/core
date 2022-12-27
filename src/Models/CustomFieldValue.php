<?php

namespace GateGem\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomFieldValue extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'custom_field_type',
        'custom_field_id',
        'field_id',
        'key',
        'value'
    ];
    protected $casts = [];
    /**
     * Get the parent CustomField model (use CustomField).
     */
    public function ParrentData()
    {
        return $this->morphTo();
    }
}
