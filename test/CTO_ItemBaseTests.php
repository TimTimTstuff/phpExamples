<?php


namespace TStuff\Test;
include 'includes.php';

use PHPUnit\Framework\TestCase;
use TStuff\cto\Person;

final class CTO_ItemBaseTests extends TestCase
{
    public function testInitializePerson(){
        $person = new Person();
        $this->assertEmpty($person->getAttributes());
    }

    public function testHasOneTracked() {
        $person = new Person();
        $person->age = 20;

        $this->assertTrue($person->propertyHasChanged(Person::age));
    }

    public function testAttributesHasValue() {
        $person = new Person();
        $person->age = 20;

        $this->assertEquals(20, $person->getAttributes()[Person::age]);
        //print_r($person);
    }

    public function testInitializedObject() {
        $person = new Person(array(Person::age=>20, Person::firstName=>'Peter'));

        $this->assertEquals('Peter', $person->firstName);
        $this->assertFalse($person->propertyHasChanged(Person::firstName));
    }


}
