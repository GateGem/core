<?php

namespace LaraPlatform\Core\Http\Action;

use Illuminate\Support\Facades\Log;
use LaraPlatform\Core\Supports\ActionBase;

class LoadPermission extends ActionBase
{
    public function DoAction()
    {
        $this->component->refreshData();
        $this->component->showMessage("LoadPermission");
        Log::info('LoadPermission');
    }
}
