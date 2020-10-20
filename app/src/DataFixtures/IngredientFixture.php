<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Persistence\ObjectManager;

class IngredientFixture extends BaseFixture
{
    public $ingredients = [
        "tomato",
        "sliced mushrooms",
        "feta cheese",
        "sausages",
        "sliced onion",
        "mozzarella cheese",
        "oregano",
    ];

    public $count = 0;

    public function loadData(ObjectManager $manager)
    {
        $this->count = count($this->ingredients);
        $this->createMany(
            Ingredient::class,
            $this->count,
            function (Ingredient $ingredient, $i) {
                $ingredient->setName($this->ingredients[$i]);
                $ingredient->setPrice($this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 6));
            }
        );
        $manager->flush();
    }
}
