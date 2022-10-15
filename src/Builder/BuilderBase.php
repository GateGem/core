<?php

namespace LaraPlatform\Core\Builder;

class BuilderBase implements IBuilder
{
    public function Config()
    {
    }
    public function BindData()
    {
    }
    public function RenderHtml()
    {
    }
    public function ToHtml()
    {
        ob_start();
        $this->RenderHtml();
        return ob_get_clean();
    }
}
