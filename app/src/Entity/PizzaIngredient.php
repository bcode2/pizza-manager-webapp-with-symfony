<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pizza
 * @ORM\Entity
 * @ORM\Table(name="pizzaIngredient")
 * @ORM\Entity(repositoryClass="App\Repository\PizzaIngredientRepository")
 */
class PizzaIngredient
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="order",type="integer")
     */
    private $order;

    /**
     * @var pizza
     * @ORM\ManyToOne(targetEntity="Pizza")
     */
    private $pizza;

    /**
     * @var Ingredient
     * @ORM\ManyToOne(targetEntity="Ingredient")
     */
    private $ingredient;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order): void
    {
        $this->order = $order;
    }

    /**
     * @return pizza
     */
    public function getPizza(): pizza
    {
        return $this->pizza;
    }

    /**
     * @param pizza $pizza
     */
    public function setPizza(pizza $pizza): void
    {
        $this->pizza = $pizza;
    }

    /**
     * @return Ingredient
     */
    public function getIngredient(): Ingredient
    {
        return $this->ingredient;
    }

    /**
     * @param Ingredient $ingredient
     */
    public function setIngredient(Ingredient $ingredient): void
    {
        $this->ingredient = $ingredient;
    }
}
