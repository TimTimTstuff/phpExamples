<?php

namespace TStuff\Test;
include 'includes.php';
use PHPUnit\Framework\TestCase;
use TStuff\cto\PersonStrict;

class CTO_ItemBaseStrictTests extends TestCase
{
    public function testItemBaseStrictInitialization() {
        $person = new PersonStrict();
        $person->age = 20;
        $this->assertEquals(20, $person->age);
    }
}
