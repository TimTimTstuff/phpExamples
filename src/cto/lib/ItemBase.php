<?php

namespace TStuff\cto\lib;

class ItemBase
{
    /**
     * @var array[string]mixed
     */
    private $attributes;
    /**
     * @var array[string]bool
     */
    private $changedProperties;

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
        $this->changedProperties[$name] = true;
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function __get($name)
    {
        return $this->getAttributeValue($name);
    }

    /**
     * ItemBase constructor.
     * @param array[string]string $attributes
     */
    function __construct($attributes = array())
    {
        $this->attributes = $attributes;
        foreach ($attributes as $identifier => $value){
            $this->{$identifier} = $value;
            $this->changedProperties[$identifier] = false;
        }
    }

    /**
     * @param string $propertyName
     * @return bool
     */
    public function propertyHasChanged($propertyName) {
        return isset($this->changedProperties[$propertyName]) && $this->changedProperties[$propertyName];
    }

    /**
     * @return array[string]mixed
     */
    public function getAttributes() {
        return $this->attributes;
    }

    /**
     * @param string $propertyName
     * @return mixed|null
     */
    public function getAttributeValue($propertyName) {
        return isset($this->attributes[$propertyName])?$this->attributes[$propertyName]:null;
    }
}