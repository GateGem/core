<?php

namespace LaraPlatform\Core\Traits;

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
    public function syncTags($tags)
    {
        $arrTags = [];
        foreach ($tags as $tag) {
            if ($tag) {
                $_tag = app($this->TagModel())->where('title', trim($tag))->first();
                if ($_tag == null) {
                    $arrTags[] = app($this->TagModel())->create(['title' => trim($tag)])->id;
                } else {
                    $arrTags[] = $_tag->id;
                }
            }
        }
        $this->Tags()->sync($arrTags);
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
