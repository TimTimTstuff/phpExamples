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
    }

    public function testPropertyHasChangedFalse() {
        $person = new Person(array(Person::age=>20, Person::firstName=>'Peter'));
        $this->assertFalse($person->propertyHasChanged(Person::firstName));
    }

    public function testPropertyHasChangedTrue() {
        $person = new Person(array(Person::age=>20, Person::firstName=>'Peter'));
        $person->firstName = 'Not Peter anymore';

        $this->assertTrue($person->propertyHasChanged(Person::firstName));
    }

    public function testAllChangedPropertiesExist() {
        $person = new Person([Person::firstName => 'FirstName', Person::lastName => 'LastName', Person::age => '30']);
        $person->age = 40;
        $person->firstName = 'NotFirstName';
        $this->assertEquals([Person::firstName => 'NotFirstName',Person::age => 40], $person->getChangedAttributes());
    }

}
