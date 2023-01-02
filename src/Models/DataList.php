<?php

namespace GateGem\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataList extends Model
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
        'content',
        'status',
        'item_default'
    ];
    protected $casts = [
    ];
    public function Items()
    {
        return $this->hasMany(DataItem::class,'list_id')->orderby('sort');
    }
}

