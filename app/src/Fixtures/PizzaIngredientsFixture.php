<?php

namespace App\DataFixtures;


use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PizzaIngredientsFixture extends BaseFixture implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(


        );
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [PizzaFixture::class, IngredientFixture::class];
    }
}
