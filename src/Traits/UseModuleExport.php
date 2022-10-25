<?php

namespace LaraPlatform\Core\Traits;

use LaraPlatform\Core\Builder\Modal\ModalSize;
use DevHau\Modules\ModuleLoader;

trait UseModuleExport
{
    public $module = '';
    public $filename = '';
    protected function getView()
    {
        return 'devhau-module::admin.table.export';
    }
    public function getOptionProperty()
    {
        return ModuleLoader::Table()->getDataByKey($this->module);
    }
    public function LoadModule($module)
    {
        if (!$module) return abort(404);
        $this->module = $module;
        $option = $this->option;
        if (!$option)
            return abort(404);

        if (!$this->isPage) {
            $this->sizeModal =  ModalSize::Small;
        }
        $this->filename = $module;
        $this->setTitle('Xuất excel ' . getValueByKey($option, 'title', ''));
    }

    public function ExportExcel()
    {
        $this->refreshData(['module' => $this->module]);
        $this->hideModal();
        $this->ShowMessage('Export Excel successful!');
        return \Excel::download((new (getValueByKey($this->option, 'excel.export', \DevHau\Modules\Excel\ExcelExport::class))($this->option)), $this->filename . '-' . time() . '.xlsx');
    }
    public function render()
    {
        return $this->viewModal($this->getView());
    }
}
