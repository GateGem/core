<?php

namespace GateGem\Core\Traits;

trait WithTagSync
{
    private $arrTags = null;
    public function TagModel()
    {
        return "";
    }
    public function getTagAttribute()
    {
        $this->arrTags = $this->getTagNames();
        return $this->arrTags;
    }

    public function setTagAttribute($tag)
    {
        $this->arrTags = $tag;
        if ($this->id > 0)
            $this->syncTags(explode(",", $this->arrTags));
    }
    public function Tags()
    {
        return $this->belongsToMany($this->TagModel());
    }
    public function syncTags($arr)
    {
        if($arr==null) return;
        if (is_string($arr)) $arr = explode(",", $arr);
        $arrCatalogs = [];
        foreach ($arr as $item) {
            if ($item) {
                $_tag = app($this->TagModel())->where('title', trim($item))->first();
                if ($_tag == null) {
                    $arrCatalogs[] = app($this->TagModel())->create(['title' => trim($item)])->id;
                } else {
                    $arrCatalogs[] = $_tag->id;
                }
            }
        }
        $this->Tags()->sync($arrCatalogs);
    }
    public function getTagNames()
    {
        $list = $this->tags()->pluck('title');
        if ($list)
            return $list->implode(',');
        return null;
    }
    public function getTags()
    {
        return $this->tags()->get();
    }
    public function initializeWithTagSync()
    {
        self::created(function ($model) {
            $model->syncTags(explode(",", $model->arrTags));
        });
    }
}
