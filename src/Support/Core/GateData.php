<?php

namespace GateGem\Core\Support\Core;

class GateData extends \ArrayObject
{
    public function setKeyData($key, $data):self
    {
        $this[$key] = $data;
        return $this;
    }
}
