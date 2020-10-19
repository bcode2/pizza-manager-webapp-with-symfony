<?php

namespace App\DataFixtures;

use App\Entity\Pizza;
use Doctrine\Persistence\ObjectManager;

class PizzaFixture extends BaseFixture
{

    protected function loadData(ObjectManager $manager)
    {
        $pizzas = [
            "Fun Pizza",
            "The Super Mushroom",
            "Margherita",
            "Marinara",
            "Quattro Stagioni",
            "Quattro Formaggi.",
        ];
        $count = count($pizzas);

        for ($i = 0; $i < $count; $i++) {
            $pizza = new Pizza();
            $pizza->setName($pizzas[$i]);
            $manager->persist($pizza);
        }

        $manager->flush();
    }
}
