<?php


namespace TStuff\impl\cto;


use TStuff\lib\cto\ItemBase;

class PersonExplained extends ItemBase
{
    const firstName = 'firstName';
    const lastName = 'lastName';
    const age = 'age';

    private $firstName;
    private $lastName;
    private $age;

    //region get set
    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        $this->notifyPropertyHasChanged(self::firstName,$firstName);
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        $this->notifyPropertyHasChanged(self::lastName,$lastName);
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
        $this->notifyPropertyHasChanged(self::age,$age);
    }
    //endregion
}