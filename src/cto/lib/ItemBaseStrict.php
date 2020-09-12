<?php


namespace TStuff\cto\lib;


use TStuff\Util\PhpDocParser;

/**
 * Extention to ItemBase to have strict property checks
 * @package TStuff\cto\lib
 */
class ItemBaseStrict extends ItemBase
{
    /**
     * @var array
     * @todo caching metadata
     */
    private static $meta = null;

    public function __construct($attributes = array())
    {
        if(self::$meta === null) self::$meta = PhpDocParser::getClassDefinedProperties(get_called_class());
        parent::__construct($attributes);
    }

    public function __get($name)
    {
        if(!array_key_exists($name,self::$meta)) throw new InvalidPropertyException('Property '.$name.' does not exist');
        return parent::__get($name);
    }

    public function __set($name, $value)
    {
        if(!array_key_exists($name,self::$meta)) throw new InvalidPropertyException('Property '.$name.' does not exist');
        parent::__set($name, $value);
    }
}