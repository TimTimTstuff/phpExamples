<?php

namespace TStuff\Test;
use PHPUnit\Framework\TestCase;
use TStuff\impl\cto\PersonStrict;
use TStuff\lib\cto\InvalidPropertyException;

class _ItemBaseStrictTests extends TestCase
{
    public function testItemBaseStrictInitialization() {
        $person = new PersonStrict();
        $person->age = 20;
        $this->assertEquals(20, $person->age);
    }

    public function testIfExceptionOnMissingProperty() {
        $this->expectException(InvalidPropertyException::class);
        $person = new PersonStrict();
        $person->age = 20;
        $person->firstName = 'FirstName';
        //Throws exception
        $person->notExistingProperty = 20;

    }
}
