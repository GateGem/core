<?php

namespace LaraIO\Core\Builder\Menu;

use LaraIO\Core\Builder\HtmlBuilder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use LaraIO\Core\Facades\Core;

class MenuBuilder extends HtmlBuilder
{
    public const ItemLink = 1;
    public const ItemRouter = 2;
    public const ItemComponent = 3;
    private $isSub = false;
    private $data = [];
    private $callbackAdd = array();
    private $isCheckActive = true;
    private $position = '';
    public function setCheckActive($flg): self
    {
        $this->isCheckActive = $flg;
        return $this;
    }
    public function __construct($isSub = true, $position = '')
    {
        $this->isSub = $isSub;
        $this->position = $position;
        $this->setId("menu-" . time())->setSort(100);
    }
    public function setValue($key, $value = '')
    {
        $this->data[$key] = $value;
        return $this;
    }
    public function getValue($key, $default = '')
    {
        if (isset($this->data[$key]) && $this->data[$key] != "") {
            return $this->data[$key];
        }
        return $default;
    }
    public function setId($id): self
    {
        return $id ? $this->setValue('id', $id) : $this;
    }
    public function setClass($class): self
    {
        return $this->setValue('class', $class);
    }
    public function setName($name): self
    {
        return $this->setValue('name', $name);
    }
    public function setIcon($icon): self
    {
        return $this->setValue('icon', $icon);
    }
    public function setAction($actionValue): self
    {
        if (!isset($this->data['actionType']) || $this->data['actionType'] == '') $this->setActionType();
        return $this->setValue('actionValue', $actionValue);
    }
    public function setActionType($actionType = MenuBuilder::ItemLink): self
    {
        return $this->setValue('actionType', $actionType);
    }
    public function setPermission($permission): self
    {
        return $this->setValue('permission', $permission);
    }
    public function getPermission()
    {
        return $this->getValue('permission');
    }
    public function setAttr($attr): self
    {
        return $this->setValue('attr', $attr);
    }
    public function setSort($sort): self
    {
        return $this->setValue('sort', $sort);
    }
    public function getSort()
    {
        return $this->getValue('sort', 0);
    }
    public function setItem($text, $icon = '', $permission = '', $actionValue = '', $actionType = MenuBuilder::ItemLink, $class = '', $id = '', $sort = 500): self
    {
        return  $this->setIcon($icon)->setId($id)->setPermission($permission)->setName($text)->setAction($actionValue)->setActionType($actionType)->setClass($class)->setSort($sort);
    }
    public function addItem($text, $icon = '', $permission = '', $actionValue = '', $actionType = MenuBuilder::ItemLink, $class = '', $id = '', $sort = 500)
    {
        $callbackAdd = function ($item) use ($text, $icon, $permission, $actionValue, $actionType, $class, $id, $sort) {
            $item->setItem($text, $icon, $permission, $actionValue, $actionType, $class, $id, $sort);
        };
        $this->callbackAdd[] = $callbackAdd;
        return $this;
    }
    public function addItemWith($callback, $text = '', $icon = '', $permission = '', $actionValue = '', $actionType = MenuBuilder::ItemLink, $class = '', $id = '', $sort = 500)
    {
        $callbackAdd = function ($item) use ($callback, $text, $icon, $permission, $actionValue, $actionType, $class, $id, $sort) {
            $item->setItem($text, $icon, $permission, $actionValue, $actionType, $class, $id, $sort);
            if (isset($callback) && $callback) $callback($item);
        };
        $this->callbackAdd[] = $callbackAdd;
        return $this;
    }
    public function checkPermission()
    {
        $permission = $this->getPermission();
        return $permission == '' || Gate::check($permission, [auth()]);
    }
    public function checkChild()
    {
        return isset($this->items) && count($this->items) > 0;
    }
    public function checkActive()
    {
        if ($this->isCheckActive == false) return false;
        if ($this->getLinkHref() == Request::url())
            return true;
        if ($this->checkChild()) {
            foreach ($this->items as $item) {
                if ($item->checkActive())
                    return true;
            }
        }
        return false;
    }
    public function checkValue($key, $value = '')
    {
        if (!isset($this->data[$key])) return false;
        if ($value) {
            return $this->data[$key] == $value;
        }
        return $this->data[$key] != '';
    }
    private $items;
    private $linkHref = "";
    public function getLinkHref()
    {
        return $this->linkHref;
    }
    private function processLinkHref()
    {
        $actionValue = $this->getValue('actionValue');
        $actionType = $this->getValue('actionType');
        if ($actionType == MenuBuilder::ItemLink) {
            $this->linkHref = $actionValue;
        } else if ($actionType == MenuBuilder::ItemRouter) {
            if (is_array($actionValue)) {
                if (!$this->getPermission()) {
                    $this->setPermission(Core::MapPermissionModule($actionValue));
                }
                $this->linkHref = route($actionValue['name'], $actionValue['param']);
            } else {
                if (!$this->getPermission()) {
                    $this->setPermission($actionValue);
                }
                $this->linkHref = route($actionValue, []);
            }
        } else {
            $this->linkHref = "";
        }
    }
    public function BindData(): self
    {
        foreach ($this->callbackAdd as $callback) {
            if ($callback == null) continue;
            $item = new MenuBuilder();
            $callback($item);
            $item->processLinkHref();
            if ($item->checkPermission()|| true) {
                $item->isCheckActive = $this->isCheckActive;
                $item->BindData();
                $this->items[] = $item;
            }
        }
        if ($this->items) {
            usort($this->items, function ($a, $b) {
                return strcmp($a->getSort(), $b->getSort());
            });
        }
        return $this;
    }

    public function RenderHtml()
    {
        echo  "<ul " . $this->getValue('attr', '') . " class='menu " . $this->getValue('class', '') . " " . ($this->isSub ? 'menu-sub' : ($this->position != '' ? ('menu-' . $this->position) : '')) . " " . $this->data['id'] . "' id='" . $this->data['id'] . "'>";
        if ($this->items) {
            foreach ($this->items as $item) {
                $attrLink = "";
                if ($item->checkValue('actionType', MenuBuilder::ItemComponent)) {
                    $attrLink = "wire:component='" . $item->getValue('actionValue') . "'";
                } else {
                    $link = $item->getLinkHref();
                    if ($link) {
                        $attrLink = 'href="' . $link . '"';
                    }
                }
                if ($attrLink == "" && $item->checkChild() == false) continue;
                $attrLink = $attrLink.' permission="'. $this->getPermission() .'" ';
                echo "<li class='menu-item " . ($item->checkActive() ? 'active' : '') . "'>";
                echo "<a $attrLink title='" . $item->getValue('name', '') . "'>";
                if ($item->checkValue('icon'))
                    echo " <i class='menu-icon " . $item->data["icon"] . "'></i> ";
                echo " <span>" . __($item->getValue('name', '')) . "</span> ";

                echo "</a>";
                if ($item->checkChild()) {
                    $item->RenderHtml();
                }
                echo "</li>";
            }
        }
        echo  "</ul>";
    }
    // STATIC
    private static $callbackHook = array();
}
