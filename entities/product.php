<?php
// Noah Gestiehr
// NKU - CSC299 - Summer 2022
// Class file for the product object

class product
{
    public $id;
    public $name;
    public $price;
    public $description;
    public $quantity;

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

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @param mixed $quantity
     * @return mixed
     */
    public function addQuantity($quantity = 1)
    {
        $this->quantity += $quantity;
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     * @return mixed
     */
    public function subtractQuantity($quantity = 1)
    {
        $this->quantity -= $quantity;
        return $this->quantity;
    }

}