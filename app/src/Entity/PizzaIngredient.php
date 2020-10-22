<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Mapping\Annotation\Sortable;


/**
 * PizzaIngredient
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
     * @Gedmo\SortablePosition
     * @ORM\Column(name="ingredientOrder",type="integer")
     */
    private $ingredientOrder;

    /**
     * @var Pizza
     * @Gedmo\SortableGroup
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
    public function getIngredientOrder()
    {
        return $this->ingredientOrder;
    }

    /**
     * @param mixed $ingredientOrder
     */
    public function setIngredientOrder($ingredientOrder): void
    {
        $this->ingredientOrder = $ingredientOrder;
    }

    /**
     * @return Pizza
     */
    public function getPizza(): Pizza
    {
        return $this->pizza;
    }

    /**
     * @param Pizza $pizza
     */
    public function setPizza(Pizza $pizza): void
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
