<?php

namespace GateGem\Core\Traits;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

trait WithSlug
{
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function ReSlug()
    {
        if (!(!in_array("slug", $this->fillable) && $this->fillable[0] !== "*") && ($this->slug == null || $this->slug == "")) {
            // produce a slug based on the activity title
            $slug = isset($this->FieldSlug) ? Str::slug($this->{$this->FieldSlug}) : Str::slug($this->title);
            if (!$slug) return;
            // check to see if any other slugs exist that are the same & count them
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            do {
                // if other slugs exist that are the same, append the count to the slug
                $this->slug = $count ? "{$slug}-{$count}" : $slug;
                if (static::where('slug',   $this->slug)->exists()) {
                    $this->slug = null;
                }
                $count++;
            } while ($this->slug == null || $count < 100);
        }
    }
    public function initializeWithSlug()
    {
        static::creating(function ($model) {
            $model->ReSlug();
        });
        static::saving(function ($model) {
            $model->ReSlug();
        });
    }
}
