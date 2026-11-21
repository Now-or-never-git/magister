<?php
class Author
{
    private $id;
    private $lastName;
    private $firstName;
    private $country;

    public function __construct($id, $lastName, $firstName, $country)
    {
        $this->id = $id;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->country = $country;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getLastName()
    {
        return $this->lastName;
    }
    public function getFirstName()
    {
        return $this->firstName;
    }
    public function getCountry()
    {
        return $this->country;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }
    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function getFullName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}
?>