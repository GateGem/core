<?php

namespace LaraPlatform\Core\Http\Livewire\Common\Option;

use LaraPlatform\Core\Livewire\Modal;

class Index extends Modal
{
    public $option_data;
    public $option_key;
    public function mount($option_key, $option_data)
    {
        $this->option_data = $option_data;
        $this->option_key = $option_key;
        foreach (getValueByKey($this->option_data, 'fields', []) as $item) {
            $this->{$item['field']} = get_option($item['field']);
        }
    }
    public function doSave()
    {
        foreach (getValueByKey($this->option_data, 'fields', []) as $item) {
            set_option($item['field'],  $this->{$item['field']});
        }
        $this->ShowMessage('Update success!');
    }
    public function render()
    {
        return $this->viewModal('core::common.option.index');
    }
}
