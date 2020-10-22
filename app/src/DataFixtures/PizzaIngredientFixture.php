<?php

namespace App\DataFixtures;

use App\Entity\PizzaIngredient;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PizzaIngredientFixture extends BaseFixture implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $pizzaReferences = [];
        $ingredientReferences = [];

        foreach ($this->referenceRepository->getReferences() as $key => $ref) {
            if (strpos($key, 'Pizza_') > 0) {
                $pizzaReferences[] = $key;
            } else {
                $ingredientReferences[] = $key;
            }
        }

        foreach ($pizzaReferences as $index => $pizza) {
            $order = 1;
            $ramdomIngredients = array_rand(array_flip($ingredientReferences), 5);

            for ($i = 0; $i < 5; $i++) {
                $pizzaIngredient = new PizzaIngredient();
                $pizzaIngredient->setPizza($this->referenceRepository->getReference($pizzaReferences[$index]));
                $pizzaIngredient->setIngredientOrder($order++);
                $ingredient = $this->referenceRepository->getReference($ramdomIngredients[$i]);
                $pizzaIngredient->setIngredient($ingredient);
                $manager->persist($pizzaIngredient);
            }
            $manager->persist($pizzaIngredient);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [PizzaFixture::class, IngredientFixture::class];
    }
}
