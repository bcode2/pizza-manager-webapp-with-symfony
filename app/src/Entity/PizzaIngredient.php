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

}
