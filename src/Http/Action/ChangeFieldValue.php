<?php

namespace LaraIO\Core\Http\Action;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use LaraIO\Core\Support\Core\ActionBase;

class ChangeFieldValue extends ActionBase
{
    public function DoAction()
    {
        if (method_exists($this->component, 'getModel')) {
            $this->component->refreshData();
            $message = getValueByKey($this->param, 'message');
            if ($message)
                $this->component->showMessage(__($message));
            $model = $this->component->getModel();
            $model = $model->where(getValueByKey($this->param, 'key', 'id'), getValueByKey($this->param, 'id'));
            $elModel = $model->first();
            if ($elModel instanceof Model) {
                $elModel->{getValueByKey($this->param, 'field', 'status')} =  getValueByKey($this->param, 'value', 0);
                Log::info($elModel->save());
                Log::info('ChangeFieldValue');
            }
        }
    }
}
