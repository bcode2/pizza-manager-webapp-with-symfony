<?php

namespace App\DataFixtures;

use App\Entity\Pizza;
use Doctrine\Persistence\ObjectManager;

class PizzaFixture extends BaseFixture
{
    private $pizzaNames = [
        "Fun Pizza",
        "The Super Mushroom",
        "Margherita",
        "Marinara",
        "Quattro Stagioni",
        "Quattro Formaggi.",
    ];
    public $count = 0;

    public function loadData(ObjectManager $manager)
    {
        $this->count = count($this->pizzaNames);
        $this->createMany(
            Pizza::class,
            $this->count,
            function (Pizza $pizza, $i) {
                $pizza->setName($this->pizzaNames[$i]);
            }
        );
        $manager->flush();
    }
}
