<?php

namespace GateGem\Core\Http\Livewire\Common\Filemanager\Form;

use GateGem\Core\Livewire\Modal;

class InputName extends Modal
{
    public const NewFolder = 1;
    public const RenameFolder = 2;
    public const RenameFile = 3;

    public $inputName;
    public $inputNameOld;
    public $buttonText = 'New Folder';
    public $placeholderText = '';
    public $input_type;
    public function mount($input_type = self::NewFolder, $name = '')
    {
        $this->inputName = $this->inputNameOld = $name;
        switch ($input_type) {
            case self::RenameFolder:
                $this->placeholderText = 'Folder Name';
                $this->buttonText = 'Rename Folder';
                $this->setTitle($this->buttonText);
                break;

            case self::RenameFile:
                $this->placeholderText = 'File Name';
                $this->buttonText = 'Rename File';
                $this->setTitle($this->buttonText);
                break;
            case self::RenameFile:
            default:
                $this->placeholderText = 'Folder Name';
                $this->buttonText = 'New Folder';
                $this->setTitle($this->buttonText);

                break;
        }
    }
    public function DoWork()
    {
        $this->emitTo('core::common.filemanager.folder', 'createFolder', $this->inputName);
        $this->hideModal();
    }
    public function render()
    {
        return $this->viewModal('core::common.filemanager.form.inputname');
    }
}
