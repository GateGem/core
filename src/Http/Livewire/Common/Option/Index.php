<?php

namespace LaraIO\Core\Http\Livewire\Common\Option;

use LaraIO\Core\Livewire\Modal;
use LaraIO\Core\Loader\OptionLoader;

class Index extends Modal
{
    private $option_data;
    public string $option_key = "";
    public function getOption()
    {
        if (!$this->option_data) {
            $option_data = OptionLoader::getDataByKey($this->option_key);
            $this->option_data = [
                ...$option_data,
                'fields' => collect($option_data['fields'])->map(function ($item) {
                    return [
                        ...$item,
                        'prex' => '_dataTemps.'
                    ];
                })->toArray()
            ];
        }
        return $this->option_data;
    }
    public function mount($option_key)
    {
        $this->option_key = $option_key;
        foreach (getValueByKey($this->getOption(), 'fields', []) as $item) {
            $this->_dataTemps[$item['field']] = get_option($item['field'], '');
        }
    }
    public function doSave()
    {
        foreach (getValueByKey($this->getOption(), 'fields', []) as $item) {
            set_option($item['field'],  $this->_dataTemps[$item['field']]);
        }
        $this->ShowMessage('Update success!');
    }
    public function render()
    {
        return $this->viewModal('core::common.option.index', [
            'option_data' => $this->getOption()
        ]);
    }
}
