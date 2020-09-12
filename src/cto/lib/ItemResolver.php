<?php


namespace TStuff\cto\lib;

use \Exception;

/**
 * Class ItemResolver
 * @package TStuff\cto\lib
 */
class ItemResolver
{

    /**
     * @var ItemBase
     */
    private $pre;
    /**
     * @var ItemBase | null
     */
    private $target;

    /**
     * ItemResolver constructor.
     * @param ItemBase $pre
     * @param ItemBase|null $target
     * @throws Exception
     */
    public function __construct($pre, $target = null)
    {
        if ($pre === null) throw new Exception('pre not allowed to be null');
        if (!($pre instanceof ItemBase || is_subclass_of($pre, ItemBase::class))) throw new Exception('pre has to be based on ItemBase');
        if ($target !== null) {
            if (!($target instanceof ItemBase || is_subclass_of($target, ItemBase::class))) throw new Exception('target has to be based on ItemBase');
        }
        $this->pre = $pre;
        $this->target = $target;

    }

    public function targetHas($identifier)
    {
        if ($this->target === null) return false;
        return isset($this->target->getAttributes()[$identifier]);
    }

    public function preHas($identifier)
    {
        return isset($this->pre->getAttributes()[$identifier]);
    }

    /**
     * @param string $identifier
     * @return mixed|null
     */
    public function resolve($identifier)
    {
        if ($this->targetHas($identifier)) return $this->target->getAttributeValue($identifier);
        return $this->pre->getAttributeValue($identifier);
    }


    public function hasChanged($identifier)
    {
        if ($this->target === null) return false;
        return $this->target->getAttributeValue($identifier) !== $this->pre->getAttributeValue($identifier);
    }

    /**
     * @return ItemBase
     */
    public function getMerged()
    {
        if ($this->target === null) return $this->pre;
        $mergedAttributes = array();
        $preAttributes = $this->pre->getAttributes();
        $targetAttributes = $this->target->getAttributes();
        foreach ($preAttributes as $key => $value) {
            $mergedAttributes[$key] = isset($targetAttributes[$key]) ? $targetAttributes[$key] : $value;
        }

        return new ItemBase($mergedAttributes);
    }
}