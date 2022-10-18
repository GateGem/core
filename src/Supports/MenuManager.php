<?php

namespace LaraPlatform\Core\Supports;

use LaraPlatform\Core\Builder\Menu\MenuBuilder;

class MenuManager
{
    private $menuPostion = [];
    public function addMenuItem($text, $icon = '', $permission = '', $actionValue = '', $actionType = MenuBuilder::ItemLink, $class = '', $id = '', $postion = 'sidebar'):MenuBuilder
    {
        if (!isset($this->menuPostion[$postion])) $this->menuPostion[$postion] = new MenuBuilder(false, $postion);
        $this->menuPostion[$postion]->addItem(function ($item) use ($text, $icon, $permission, $actionValue, $actionType, $class, $id) {
            $item->setItem($text, $icon, $permission, $actionValue, $actionType, $class, $id);
        });
        return $this->menuPostion[$postion];
    }
    public function addMenuSub($text, $callback,$icon = '', $class = '', $id = '', $postion = 'sidebar'):MenuBuilder
    {
        if (!isset($this->menuPostion[$postion])) $this->menuPostion[$postion] = new MenuBuilder(false, $postion);
        $this->menuPostion[$postion]->addItem(function ($itemSub) use ($text, $icon,$callback,  $class, $id) {
            $itemSub->setItem($text, $icon, '', '','', $class, $id);
            if($callback){
                $callback($itemSub);
            }
        });
        return $this->menuPostion[$postion];
    }
    public function doRender($postion)
    {
        if (!isset($this->menuPostion[$postion])) return;
        $this->menuPostion[$postion]->BindData()->RenderHtml();
    }
    public function getHtml($postion)
    {
        if (!isset($this->menuPostion[$postion])) return '';
        return  $this->menuPostion[$postion]->BindData()->ToHtml();
    }
}
