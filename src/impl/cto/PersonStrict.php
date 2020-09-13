<?php


namespace TStuff\impl\cto;


use TStuff\lib\cto\ItemBaseStrict;

/**
 * Class PersonStrict
 * @package TStuff\cto
 * @property string firstName
 * @property string lastName
 * @property int age
 */
class PersonStrict extends ItemBaseStrict
{
    const firstName = 'firstName';
    const lastName = 'lastName';
    const age = 'age';
}