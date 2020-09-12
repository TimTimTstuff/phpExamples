<?php

namespace TStuff\cto\lib;

/**
 * Provides a trackable
 * @package TStuff\cto\lib
 */
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
     * @var string
     */
    protected $attrPrefix = '';

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {   $name = $this->attrPrefix.$name;
        $this->attributes[$name] = $value;
        $this->changedProperties[$name] = true;
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function __get($name)
    {
        $name = $this->attrPrefix.$name;
        return $this->getAttributeValue($name);
    }

    /**
     * ItemBase constructor.
     * @param array[string]string $attributes
     * @param string $preFix
     */
    function __construct($attributes = array(), $preFix = '')
    {
        $this->attributes = $attributes;

        if($preFix !== '')
            $this->attrPrefix = $preFix;

        foreach ($attributes as $identifier => $value){
            $this->changedProperties[$this->attrPrefix.$identifier] = false;
        }
    }

    /**
     * @param string $propertyName
     * @return bool
     */
    public function propertyHasChanged($propertyName) {
        $propertyName = $this->attrPrefix.$propertyName;
        return isset($this->changedProperties[$propertyName]) && $this->changedProperties[$propertyName];
    }

    /**
     * @return array[string]mixed
     */
    public function getAttributes() {
        return $this->attributes;
    }

    /**
     * @return string
     */
    public function getPrefix() {
        return $this->attrPrefix;
    }

    /**
     * @param string $propertyName
     * @return mixed|null
     */
    public function getAttributeValue($propertyName) {
        $propertyName = $this->attrPrefix.$propertyName;
        return isset($this->attributes[$propertyName])?$this->attributes[$propertyName]:null;
    }

    /**
     * @return array[string]mixed
     */
    public function getChangedAttributes() {
        $result = array();
        foreach ($this->changedProperties as $identifier => $hasChanged){
            if($hasChanged)
                $result[$identifier] = $this->attributes[$identifier];
        }
        return $result;
    }
}