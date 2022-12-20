<?php

namespace GateGem\Core\Http\Livewire\Common\Option;

use GateGem\Core\Livewire\Modal;
use GateGem\Core\Loader\OptionLoader;

class Index extends Modal
{
    private $option_data;
    public string $option_key = "";
    public function getOption()
    {
        if (!$this->option_data) {
            /*
             * @var \GateGem\Core\Support\Config\OptionConfig
             */
            $option_data = OptionLoader::getDataByKey($this->option_key);
            $this->option_data = $option_data;
            $this->option_data->setFields(collect($option_data->getFields())->map(function (\GateGem\Core\Support\Config\FieldConfig $item) {
                $item->setPrex('_dataTemps.');
                return $item;
            })->toArray());
        }
        return $this->option_data;
    }
    public function mount($option_key)
    {
        $this->option_key = $option_key;
        foreach ($this->getOption()->getFields() as $item) {
            $this->_dataTemps[$item->getField()] = get_option($item->getField(), '');
        }
    }
    public function doSave()
    {
        foreach ($this->getOption()->getFields()  as $item) {
            set_option($item->getField(),  $this->_dataTemps[$item->getField()]);
        }
    }
    public function render()
    {
        return $this->viewModal('core::common.option.index', [
            'option_data' => $this->getOption()
        ]);
    }
}
