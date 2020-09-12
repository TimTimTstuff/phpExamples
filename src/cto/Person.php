<?php

namespace TStuff\cto;

use TStuff\cto\lib\ItemBase;

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