<?php

namespace GateGem\Core\Traits;

use Livewire\WithFileUploads;

trait WithFieldSave
{
    use WithFileUploads;
    public function getFieldValueData($value, $item, $default)
    {
        $valuePreview = $value ?? $default;
        if ($value && $item) {

            if ($valuePreview && $valuePreview instanceof \Illuminate\Http\UploadedFile) {
                if ($folder = $item->getFolder())
                    $valuePreview = $valuePreview->store('public/' . $folder);
                else
                    $valuePreview = $valuePreview->store('public');
                $valuePreview = str_replace('public', 'storage', $valuePreview);
            }
        }
        return  $valuePreview;
    }
}
