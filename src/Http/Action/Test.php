<?php

namespace GateGem\Core\Http\Action;

use GateGem\Core\Support\Core\ActionBase;

class Test extends ActionBase
{
    public function DoAction()
    {
        $this->component->showMessage("Xin chào, i'am vietnam");
    }
}
