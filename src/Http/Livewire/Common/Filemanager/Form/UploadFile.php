<?php

namespace GateGem\Core\Http\Livewire\Common\Filemanager\Form;

use GateGem\Core\Livewire\Modal;
use Livewire\WithFileUploads;

class UploadFile extends Modal
{
    use WithFileUploads;

    public $disk;
    public $path_current;
    public $file;
    public function mount($path, $disk)
    {
        $this->setTitle('Upload File');
        $this->disk = $disk;
        $this->path_current = $path;
    }
    public function DoWork()
    {
        $this->file->storeAs($this->path_current, $this->file->getClientOriginalName(), [
            'disk' => $this->disk
        ]);
        $this->emitTo('core::common.filemanager.file', 'selectPath', $this->path_current, $this->disk);
        $this->hideModal();
    }
    public function render()
    {
        return $this->viewModal('core::common.filemanager.form.upload-file');
    }
}
