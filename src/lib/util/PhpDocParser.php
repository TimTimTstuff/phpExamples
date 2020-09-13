<?php

namespace TStuff\lib\util;

/**
 * Reference to Reflection http://php.net/manual/de/class.reflectionclass.php
 */
class PhpDocParser
{

    /**
     * @param $className
     * @return array
     * @throws \ReflectionException
     */
    public static function getClassDefinedProperties($className){
        $reflector = new \ReflectionClass($className);
        $properties = self::parseDocTextClass($reflector->getDocComment());
        $result = array();

        foreach ($properties[0] as $k => $v){
            if($v === 'property'){
                $data = trim($properties[1][$k]);
                $e = explode(' ',$data);
                $result[$e[1]] = $e[0];
            }
        }

        return $result;
    }

    /**
     * @param $className
     * @return array
     * @throws \ReflectionException
     */
    public static function getPropertyDocAsArray($className){
        $reflector = new \ReflectionClass($className);
        $refParam = $reflector->getProperties();
        $result = array();
        foreach ($refParam as $value) {
            if(!$value->isPublic())continue;
            $doc = $value->getDocComment();
            $result[$value->name] = self::parseDocTextProperty($doc);
        }
        return $result;
    }

    private static function parseDocTextProperty( $doc){
        $result = array();
        if (preg_match_all('/@(\w+)\s+(.*)\r?\n/m', $doc, $matches)){

            $result = array_combine($matches[1], $matches[2]);
        }
        return $result;
    }
    private static function parseDocTextClass( $doc){
        $result = array();
        if (preg_match_all('/@(\w+)\s+(.*)\r?\n/m', $doc, $matches)){
            $result = [$matches[1],$matches[2]];
        }
        return $result;
    }


}