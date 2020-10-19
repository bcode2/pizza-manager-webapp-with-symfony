<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Persistence\ObjectManager;

class IngredientFixture extends BaseFixture
{

    protected function loadData(ObjectManager $manager)
    {
        $ingredients = [
            "tomato",
            "sliced mushrooms",
            "feta cheese",
            "sausages",
            "sliced onion",
            "mozzarella cheese",
            "oregano",
        ];
        $count = count($ingredients);

        for ($i = 0; $i < $count; $i++) {
            $ingredient = new Ingredient();
            $ingredient->setName($ingredients[$i]);
            $ingredient->setPrice($this->faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 10));
            $ingredient->persist($ingredient);
        }

        $manager->flush();
    }
}
