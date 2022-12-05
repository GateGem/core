<?php

namespace GateGem\Core\Traits;

use GateGem\Core\Livewire\Modal;
use GateGem\Core\Loader\TableLoader;
use Livewire\WithFileUploads;

trait WithTableImport
{
    use WithFileUploads;
    public $module = '';
    public $filename = '';
    protected function getView()
    {
        return 'core::common.table.import';
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
        $this->setTitle('Nhập excel ' . getValueByKey($option, 'title', ''));
    }

    public function ImportExcel()
    {
        $this->refreshData(['module' => $this->module]);
        $this->hideModal();
        $this->ShowMessage('Import Excel successful!');
    }
    public function render()
    {
        return $this->viewModal($this->getView());
    }
}
