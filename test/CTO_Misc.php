<?php


use PHPUnit\Framework\TestCase;
use TStuff\cto\Person;
include 'includes.php';

class CTO_Misc extends TestCase
{
    /**
     *  Solution : ItemBase could have a toJson() / or fromJason (internal array)
     */
    public function testIfJsonSerializeWorks() {
        $this->markTestSkipped('S whiteout real properties it is not possible to serialize with the default serializer');
        $person = new Person();
        $person->firstName = 'FirstName';
        $person->lastName = 'LastName';
        $person->age = 31;

        $serialized = json_encode($person);
        /**
         * @var Person $deserialized
         */
        $deserialized = json_decode($serialized);
        print_r($serialized);
        $this->assertEquals('FirstName',$deserialized->firstName);
        $this->assertEquals('LastName',$deserialized->lastName);
        $this->assertEquals(31,$deserialized->age);

    }

    /**
     *  Solution : ItemBase has 'hasAttribute'
     */
    public function testIfPropertyExistsWork() {
        $this->markTestSkipped('S whiteout real properties it is not possible to serialize with the default serializer');
        $person = new Person();
        $person->firstName = 'FirstName';
        $this->assertTrue(property_exists($person,'firstName'));
    }

    /**
     *
     */
    public function testIfPropertyExistsOnExplainedObject() {

        $person = new \TStuff\cto\lib\PersonExplained();
        $person->setFirstName('FirstName');
        $this->assertTrue(property_exists($person,'firstName'));
    }
}
