<?php

namespace TStuff\Test;
include 'includes.php';
use PHPUnit\Framework\TestCase;
use TStuff\cto\lib\ItemResolver;
use TStuff\cto\Person;

class CTO_ItemResolverTests extends TestCase
{
    public function testItemResolverInitialize() {
        $personFromDb = new Person([Person::firstName => 'Torben', Person::lastName => 'Peters', Person::age => 30]);
        $personFromSomeOneChanged = new Person([Person::firstName => 'Torben', Person::lastName => 'NeuerName', Person::age => 31]);

        $resolver = new ItemResolver($personFromDb, $personFromSomeOneChanged);

    }
}
