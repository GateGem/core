<?php

namespace GateGem\Core\Support\Core;

class GateData extends \ArrayObject
{
    public function __set($name, $val)
    {
        $this[$name] = $val;
    }

    public function __get($name)
    {
        return $this[$name];
    }
    public function checkKey($key)
    {
        return isset($this[$key]);
    }
    public function checkCallable($key)
    {
        return isset($this[$key]) && is_callable($this[$key]);
    }
    public function getDataValue($key, $default = '')
    {
        return isset($this[$key]) ? $this[$key] : $default;
    }
    public function setKeyData($key, $data): self
    {
        $this[$key] = $data;
        return $this;
    }
}
