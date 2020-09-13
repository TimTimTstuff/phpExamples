<?php

namespace TStuff\impl\cto;


use TStuff\lib\cto\ItemBase;

/**
 * Class Person
 * @package TStuff\cto
 * @property string firstName
 * @property string lastName
 * @property int age
 */
class Person extends ItemBase
{
    const firstName = 'firstName';
    const lastName = 'lastName';
    const age = 'age';
}