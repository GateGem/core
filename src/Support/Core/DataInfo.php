<?php

namespace GateGem\Core\Support\Core;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use GateGem\Core\Facades\Core;

class DataInfo implements \ArrayAccess
{
    const Active = 1;
    const UnActive = 0;
    private $path;
    private $public;
    private $fileInfo;
    private $base_type;
    protected $data;
    public $parent;
    public function __construct($path, $parent)
    {
        $this->parent = $parent;
        $this->path = $path;
        $this->public = $parent->PublicFolder();
        $this->fileInfo = $parent->FileInfoJson();
        $this->base_type = $parent->getName();
        $this->ReLoad();
    }
    public function ReLoad()
    {
        $this->data = Core::FileJson($this->path . '/' . $this->fileInfo) ?? [];
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
    public function __get($key)
    {
        if (method_exists($this->parent, 'get' . Str::studly($key) . 'Data'))
            return $this->parent->{'get' . Str::studly($key) . 'Data'}($this);
        if (method_exists($this, 'get' . Str::studly($key) . 'Data'))
            return $this->{'get' . Str::studly($key) . 'Data'}();
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
        if (method_exists($this->parent, 'set' . Str::studly($key) . 'Data'))
            return $this->parent->{'set' . Str::studly($key) . 'Data'}($this, $value);
        if (method_exists($this, 'set' . Str::studly($key) . 'Data'))
            return $this->{'set' . Str::studly($key) . 'Data'}($value);
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
        if (method_exists($this->parent, 'get' . Str::studly($key) . 'Data'))
            return true;
        if (method_exists($this, 'get' . Str::studly($key) . 'Data'))
            return true;
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
        } else if (method_exists($this->parent, 'set' . Str::studly($offset) . 'Data')) {
            return $this->parent->{'set' . Str::studly($offset) . 'Data'}($this, $value);
        } else if (method_exists($this, 'set' . Str::studly($offset) . 'Data')) {
            return $this->{'set' . Str::studly($offset) . 'Data'}($value);
        } else {
            $this->data[$offset] = $value;
        }
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
        if (method_exists($this->parent, 'get' . Str::studly($offset) . 'Data'))
            return true;
        if (method_exists($this, 'get' . Str::studly($offset) . 'Data'))
            return true;
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
    public function __toString()
    {
        return $this->getName();
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
        if (!is_null($offset) && method_exists($this->parent, 'get' . Str::studly($offset) . 'Data'))
            return $this->parent->{'get' . Str::studly($offset) . 'Data'}($this);
        if (!is_null($offset) && method_exists($this, 'get' . Str::studly($offset) . 'Data'))
            return $this->{'get' . Str::studly($offset) . 'Data'}();
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

    public function getFiles()
    {
        return $this->getValue('files', []);
    }
    public function getProviders()
    {
        return $this->getValue('providers', []);
    }
    public function getKey()
    {
        return $this->getValue('key');
    }
    public function getName()
    {
        return $this->getValue('name');
    }
    protected function getKeyOption($key)
    {
        return trim(Str::lower("option_datainfo_" . $this->base_type . '_' . $this->getKey() . '_' . $key . '_value'));
    }
    public function getStatusData()
    {
        return get_option($this->getKeyOption('status'));
    }
    public function setStatusData($value)
    {
        if ($value == self::Active && !$this->checkDump()) {
            $this->Dump();
        }
        return set_option($this->getKeyOption('status'), $value);
    }
    public function isActive()
    {
        return $this['status'] == self::Active;
    }
    public function Active()
    {
        $this['status'] = self::Active;
    }
    public function UnActive()
    {
        $this['status'] = self::UnActive;
    }
    public function delete()
    {
        Core::delete($this->getPath());
    }
    public function checkComposer()
    {
        return Core::FileExists($this->getPath('composer.json'));
    }
    public function checkDump()
    {
        return Core::FileExists($this->getPath('vendor/autoload.php'));
    }
    public function Dump()
    {
        chdir($this->getPath());
        passthru('composer dump -o -n -q');
    }
    public function update()
    {
    }
    public function CheckName($name)
    {
        return $this->getKey() == $name || $this->getValue('name') == $name;
    }
    public function getStudlyName()
    {
        return Str::studly($this->getName());
    }
    public function getLowerName()
    {
        return Str::lower($this->getName());
    }
    private $providers;
    public function DoRegister($namespace = null)
    {
        if ($this->checkComposer() && !$this->checkDump()) {
            $this->Dump();
        }
        if ($this->checkDump()) {
            Core::LoadHelper($this->getPath('vendor/autoload.php'));
        }
        $providers = $this->getProviders();
        if (is_array($providers) && count($providers) > 0) {
            if (!$this->checkDump()) {
                Core::RegisterAllFile($this->getPath('src'));
            }
            if (!Core::LoadHelper($this->getPath('vendor/autoload.php')))
                Core::RegisterAllFile($this->getPath('src'));
            $this->providers =  collect($providers)->map(function ($item) {
                return app()->register($item, true);
            });
        } else {
            Core::loadViewsFrom($this->getPath('resources/views'), $namespace);
            Core::Link($this->getPath('public'), $this->getPublic($this->getKey()));
        }
        foreach ($this->getFiles() as $file) {
            Core::LoadHelper($this->getPath($file));
        }
    }
    public function DoBoot()
    {
        if (isset($this->providers) && $this->providers != null && is_array($this->providers) && count($this->providers) > 0) {
            foreach ($this->providers as $item) {
                if (method_exists($item, 'boot'))
                    $item->boot();
            }
        }
    }
}
