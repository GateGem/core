<?php

namespace GateGem\Core\Support\Config;

use GateGem\Core\Support\Core\GateData;

class ConfigManager  extends GateData
{
    public const TITLE = "title";
    public const DISABLE_MODULE = "DisableModule";
    public const FUNC_QUERY = "funcQuery";
    public const FUNC_DATA = "funcData";
    public const MODEL_KEY = "modelkey";
    public const MODEL = "model";
    public const FORM = "form";
    public const FIELDS = "fields";
    public function setFields(array $fields = []): self
    {
        $this[self::FIELDS] = $fields;
        return $this;
    }
    public function setForm($value): self
    {
        $this[self::FORM] = $value;
        return $this;
    }
    public function setModel($value): self
    {
        $this[self::MODEL] = $value;
        return $this;
    }
    public function setModelKey($value = "id"): self
    {
        $this[self::MODEL_KEY] = $value;
        return $this;
    }
    public function setTitle($value): self
    {
        $this[self::TITLE] = $value;
        return $this;
    }
    public function disableModule($value = true): self
    {
        $this[self::DISABLE_MODULE] = $value;
        return $this;
    }
    public function setFuncQuery(callable $callback): self
    {
        $this[self::FUNC_QUERY] = $callback;
        return $this;
    }
    public function setFuncData(callable| array $callback): self
    {
        $this[self::FUNC_DATA] = $callback;
        return $this;
    }
    public function Field(): FieldConfig
    {
        return new FieldConfig();
    }
    public function Form(): FormConfig
    {
        return new FormConfig();
    }
    public function NewItem(): self
    {
        return new self;
    }
}
