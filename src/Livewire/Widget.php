<?php

namespace GateGem\Core\Livewire;

use GateGem\Core\Loader\DashboardLoader;
use GateGem\Core\Support\Config\WidgetConfig;

class Widget extends Component
{
    public $key_widget = '';
    public $widget_data = [];
    public $widget_title = "";
    public $widget_view = "";
    public $widget_column = "";
    public $widget_poll = "";

    protected WidgetConfig $widget_config;
    public function process_data()
    {
        $this->widget_config = DashboardLoader::getDataByKey($this->key_widget);
        $this->widget_title =  $this->widget_config->getTitle();
        $this->widget_column =  $this->widget_config->getColumn();
        $this->widget_column =  $this->widget_config->getColumn();
    }
    public function mount($key_widget)
    {
        $this->key_widget = $key_widget;
        if (method_exists($this, 'process_data')) {
            $this->process_data();
        }
    }
}
