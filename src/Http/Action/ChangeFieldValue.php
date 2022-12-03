<?php

namespace LaraIO\Core\Http\Action;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use LaraIO\Core\Support\Core\ActionBase;
use LaraIO\Core\Support\Core\DataInfo;

class ChangeFieldValue extends ActionBase
{
    public function DoAction()
    {
        if (method_exists($this->component, 'getModel')) {
           
            $message = getValueByKey($this->param, 'message');
            if ($message)
                $this->component->showMessage(__($message));
            $model = $this->component->getModel();
            $elModel = $model->where(getValueByKey($this->param, 'key', 'id'), getValueByKey($this->param, 'id'))->first();

            Log::info($elModel);
            if ($elModel == null) {
                $this->component->showMessage(__('core::message.not-founds'));
                return;
            }
            if ($elModel instanceof Model) {
                $elModel->{getValueByKey($this->param, 'field', 'status')} =  getValueByKey($this->param, 'value', 0);
                $elModel->save();
            } else if ($elModel instanceof DataInfo) {
                $elModel[getValueByKey($this->param, 'field', 'status')] =  getValueByKey($this->param, 'value', 0);
            }
            $this->component->refreshData();
        }
    }
}
