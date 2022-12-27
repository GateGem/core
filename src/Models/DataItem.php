<?php

namespace GateGem\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'list_id',
        'list_key',
        'title',
        'link',
        'image',
        'content_short',
        'content',
        'status',
        'sort'
    ];
    protected $casts = [
    ];
    public function DataList()
    {
        return $this->belongsTo(DataList::class,'list_id');
    }
}

