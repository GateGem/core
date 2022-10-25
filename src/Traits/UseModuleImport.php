<?php

namespace LaraPlatform\Core\Traits;

use LaraPlatform\Core\Builder\Modal\ModalSize;
use DevHau\Modules\ModuleLoader;
use Livewire\WithFileUploads;

trait UseModuleImport
{
    use WithFileUploads;
    public $module = '';
    public $filename = '';
    protected function getView()
    {
        return 'devhau-module::admin.table.import';
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
