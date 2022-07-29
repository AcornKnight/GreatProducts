<?php
// Noah Gestiehr
// NKU - CSC299 - Summer 2022
// Class file for the category object

class Category
{
    public $id;
    public $name;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


}
?>