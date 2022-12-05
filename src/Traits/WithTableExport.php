<?php

namespace GateGem\Core\Traits;

use GateGem\Core\Livewire\Modal;
use GateGem\Core\Loader\TableLoader;

trait WithTableExport
{
    public $module = '';
    public $filename = '';
    protected function getView()
    {
        return 'core::common.table.export';
    }
    public function getOptionProperty()
    {
        return TableLoader::getDataByKey($this->module);
    }
    public function LoadModule($module)
    {
        if (!$module) return abort(404);
        $this->module = $module;
        $option = $this->option;
        if (!$option)
            return abort(404);

        if (!$this->modal_isPage) {
            $this->sizeModal =  Modal::Small;
        }
        $this->filename = $module;
        $this->setTitle('Xuất excel ' . getValueByKey($option, 'title', ''));
    }

    public function ExportExcel()
    {
        $this->refreshData(['module' => $this->module]);
        $this->hideModal();
        $this->ShowMessage('Export Excel successful!');
        //return \Excel::download((new (getValueByKey($this->option, 'excel.export', \GateGem\Core\Excel\ExcelExport::class))($this->option)), $this->filename . '-' . time() . '.xlsx');
    }
    public function render()
    {
        return $this->viewModal($this->getView());
    }
}
