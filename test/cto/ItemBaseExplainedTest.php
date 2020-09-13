<?php


namespace TStuff\Test;
use PHPUnit\Framework\TestCase;
use TStuff\impl\cto\PersonExplained;


final class _ItemBaseExplainedTests extends TestCase
{
    public function testInitializePerson(){
        $person = new PersonExplained();
        $this->assertEmpty($person->getAttributes());
    }

    public function testHasOneTracked() {
        $person = new PersonExplained();
        $person->setAge(20);

        $this->assertTrue($person->propertyHasChanged(PersonExplained::age));
    }

    public function testAttributesHasValue() {
        $person = new PersonExplained();
        $person->setAge(20);

        $this->assertEquals(20, $person->getAttributes()[PersonExplained::age]);
    }

    public function testPropertyHasChangedFalse() {
        $person = new PersonExplained(array(PersonExplained::age=>20, PersonExplained::firstName=>'Peter'));
        $this->assertFalse($person->propertyHasChanged(PersonExplained::firstName));
    }

    public function testPropertyHasChangedTrue() {
        $person = new PersonExplained(array(PersonExplained::age=>20, PersonExplained::firstName=>'Peter'));
        $person->setFirstName('Not Peter anymore');

        $this->assertTrue($person->propertyHasChanged(PersonExplained::firstName));
        $this->assertEquals('Not Peter anymore', $person->getFirstName());
    }

    public function testAllChangedPropertiesExist() {
        $person = new PersonExplained([PersonExplained::firstName => 'FirstName', PersonExplained::lastName => 'LastName', PersonExplained::age => '30']);
        $person->setAge(40);
        $person->setFirstName('NotFirstName');
        $this->assertEquals([PersonExplained::firstName => 'NotFirstName',PersonExplained::age => 40], $person->getChangedAttributes());
    }

}
