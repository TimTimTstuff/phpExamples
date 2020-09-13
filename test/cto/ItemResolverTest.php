<?php

namespace TStuff\Test;
use PHPUnit\Framework\TestCase;
use TStuff\impl\cto\Person;
use TStuff\lib\cto\ItemResolver;





class _ItemResolverTests extends TestCase
{
    public function testItemResolverInitialize()
    {
        $personFromDb = new Person([Person::firstName => 'Torben', Person::lastName => 'Peters', Person::age => 30]);
        $personFromSomeOneChanged = new Person([Person::lastName => 'NeuerName', Person::age => 31]);

        $resolver = new ItemResolver($personFromDb, $personFromSomeOneChanged);
        $this->assertEquals(31, $resolver->resolve(Person::age));
    }

    public function testMergedValues()
    {
        $personFromDb = new Person([Person::lastName => 'Peters', Person::age => 30]);
        $personFromSomeOneChanged = new Person([Person::firstName => 'Torben', Person::lastName => 'NeuerName', Person::age => 31]);

        $resolver = new ItemResolver($personFromDb, $personFromSomeOneChanged);
        /** @var Person $merged */
        $merged = $resolver->merge();
        $this->assertEquals('Torben', $merged->firstName);
        $this->assertEquals('NeuerName', $merged->lastName);
        $this->assertEquals(31, $merged->age);
    }

    public function testPreAndTargetStaySameAfterMerge()
    {
        $personFromDb = new Person([Person::lastName => 'Peters', Person::age => 30]);
        $personFromSomeOneChanged = new Person([Person::firstName => 'Torben', Person::lastName => 'NeuerName', Person::age => 31]);

        $resolver = new ItemResolver($personFromDb, $personFromSomeOneChanged);
        /** @var Person $merged */
        $resolver->merge();
        $this->assertEquals('Peters', $resolver->getPre()->getAttributeValue(Person::lastName));
        $this->assertEquals('NeuerName', $resolver->getTarget()->getAttributeValue(Person::lastName));

    }
}
