<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OrderBy;

/**
 * Pizza
 * @ORM\Entity
 * @ORM\Table(name="pizza")
 * @ORM\Entity(repositoryClass="App\Repository\PizzaRepository")
 */
class Pizza
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=180)
     */
    private $name;

    /**
     * @var Collection|PizzaIngredient[]
     * @ORM\OneToMany(targetEntity="PizzaIngredient", mappedBy="pizza", cascade={"persist", "remove"})
     * @OrderBy({"ingredientOrder" = "ASC"})
     */
    private $pizzaIngredients;

    private $price;

    public function __construct()
    {
        $this->pizzaIngredients = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Pizza
     */
    public function setName(string $name): Pizza
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get price.
     *
     * @return int
     */
    public function getPrice(): ?int
    {
        $price = 0;
        foreach ($this->getPizzaIngredients() as $ingredient) {
            $price += $ingredient->getIngredient()->getPrice();
        }

        return $price * 1.5;
    }

    /**
     * @return PizzaIngredient[]|Collection
     */
    public function getPizzaIngredients()
    {
        return $this->pizzaIngredients;
    }

    /**
     * @param PizzaIngredient[]|Collection $pizzaIngredients
     */
    public function setPizzaIngredients($pizzaIngredients): void
    {
        $this->pizzaIngredients = $pizzaIngredients;
    }
}
