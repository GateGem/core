<?php

namespace LaraIO\Core\Support\Core;

use Illuminate\Support\Facades\Log;
use LaraIO\Core\Facades\Core;
use LaraIO\Core\Utils\BaseScan;

class DataInfo implements \ArrayAccess
{
    const Active = 1;
    const UnActive = 0;
    private $path;
    private $public;
    private $fileInfo;
    private $data;
    public function __construct($path, $fileInfo, $public)
    {
        $this->path = $path;
        $this->public = $public;
        $this->fileInfo = $fileInfo;
        $this->ReLoad();
    }
    public function ReLoad()
    {
        $this->data = BaseScan::FileJson($this->path . '/' . $this->fileInfo) ?? [];
        $this->data['fileInfo'] = $this->fileInfo;
        $this->data['path'] = $this->path;
        $this->data['key'] = basename($this->path, ".php");
    }
    /**
     * Get a data by key
     *
     * @param string The key data to retrieve
     * @access public
     */
    public function &__get($key)
    {
        return $this->getValue($key);
    }

    /**
     * Assigns a value to the specified data
     * 
     * @param string The data key to assign the value to
     * @param mixed  The value to set
     * @access public 
     */
    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * Whether or not an data exists by key
     *
     * @param string An data key to check for
     * @access public
     * @return boolean
     * @abstracting ArrayAccess
     */
    public function __isset($key)
    {
        return isset($this->data[$key]);
    }

    /**
     * Unsets an data by key
     *
     * @param string The key to unset
     * @access public
     */
    public function __unset($key)
    {
        unset($this->data[$key]);
    }

    /**
     * Assigns a value to the specified offset
     *
     * @param string The offset to assign the value to
     * @param mixed  The value to set
     * @access public
     * @abstracting ArrayAccess
     */
    public function offsetSet($offset,  $value)
    {
        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }

        Log::info($value);
    }

    /**
     * Whether or not an offset exists
     *
     * @param string An offset to check for
     * @access public
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    /**
     * Unsets an offset
     *
     * @param string The offset to unset
     * @access public
     */
    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset)) {
            unset($this->data[$offset]);
        }
    }

    /**
     * Returns the value at specified offset
     *
     * @param string The offset to retrieve
     * @access public
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->data[$offset] : null;
    }
    public function checkKeyValue($key, $value)
    {
        return $this->getValue($key) == $value;
    }

    public function getValue($key, $default = '')
    {
        return getValueByKey($this->data, $key, $default);
    }

    public function getPath($_path = '')
    {
        return $this->path . ($_path ? ('/' . $_path) : '');
    }
    public function getPublic($_path = '')
    {
        return $this->public . ($_path ? ('/' . $_path) : '');
    }
    public function getKey()
    {
        return $this->getValue('key');
    }
    public function setStatus($status)
    {
        if ($this->getValue('status') !== $status) {
            $this->data['status'] = $status;
        }
    }
    public function delete()
    {
        BaseScan::delete($this->getPath());
    }
    public function CheckName($name)
    {
        return $this->getKey() == $name || $this->getValue('name') == $name;
    }
    public function DoSave()
    {
        Log::info($this->data);
        $data = $this->data;
        unset($data['fileInfo']);
        unset($data['path']);
        unset($data['key']);
        BaseScan::SaveFileJson($this->getPath($this->data['fileInfo']), $data);
        Log::info($data);
        Log::info($this->getPath($this->data['fileInfo']));
    }
    public function DoActive($namespace)
    {
        Core::loadViewsFrom($this->getPath('views'), $namespace);
        Core::LoadHelper($this->getPath('function.php'));
        BaseScan::Link($this->getPath('public'), $this->getPublic($this->getKey()));
    }
}
