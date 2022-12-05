<?php

namespace GateGem\Core\Schedule;

use GateGem\Core\Models\Schedule;

class ScheduleService
{
    private $model;

    public function __construct()
    {
        $this->model = app(Schedule::class);
    }

    public function getActives()
    {
        if (config('app.debug')) {
            return $this->model->active()->get();
        }

        return $this->getFromCache();
    }

    public function clearCache()
    {
        $store = config('cache.default');
        $key = config('cache.schedule_key');

        cache()->store($store)->forget($key);
    }

    private function getFromCache()
    {
        $store = config('cache.default');
        $key = config('cache.schedule_key');

        return cache()->store($store)->rememberForever($key, function () {
            return $this->model->active()->get();
        });
    }
}
