<?php

namespace App\Services;

use App\Entity\Ingredient;
use App\Entity\Pizza;
use App\Entity\PizzaIngredient;
use App\Repository\IngredientRepository;
use App\Repository\PizzaIngredientRepository;
use App\Repository\PizzaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class PizzaService extends AbstractEntityService

{
    private $repository;
    protected $em;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        parent::__construct($entityManager);
    }

    public function getAll(): array
    {
        return $this->getPizzaRepository()->findAll();
    }

    /**
     * @param $id
     *
     * @return Pizza|object|null
     */
    public function findOneById(int $id): Pizza
    {
        return $this->getPizzaRepository()->find($id);
    }


    public function create(Pizza $pizza): int
    {
        $this->getEntityManager()->persist($pizza);
        $this->getEntityManager()->flush();

        return $pizza->getId();
    }

    /**
     * @param Pizza $entity
     *
     * @return Pizza
     */
    public function delete(Pizza $entity): Pizza
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();

        return $entity;
    }

    public function getById(int $id)
    {
        return $this->repository->find($id);
    }

    public function update(): void
    {
        $this->getEntityManager()->flush();
    }

    /**
     * @param PizzaIngredient $pizzaIngredient
     *
     * @return void
     */
    public function deletePizzaIngredient(PizzaIngredient $pizzaIngredient): void
    {
        $this->getEntityManager()->remove($pizzaIngredient);
        $this->getEntityManager()->flush();
    }

    /**
     * @return PizzaRepository|ObjectRepository
     */
    public function getPizzaRepository(): ObjectRepository
    {
        return $this->getEntityManager()->getRepository(Pizza::class);
    }

    /**
     * @return PizzaIngredientRepository|ObjectRepository
     */
    public function getPizzaIngredientRepository(): ObjectRepository
    {
        return $this->getEntityManager()->getRepository(PizzaIngredient::class);
    }


    /**
     * @return PizzaIngredientRepository|ObjectRepository
     */
    public function getIngredientRepository(): ObjectRepository
    {
        return $this->getEntityManager()->getRepository(Ingredient::class);
    }

    /**
     * @param $ids
     *
     * @return array
     */
    public function getIngredientsToAdd($ids): array
    {
        return $this->getEntityManager()->getRepository(Ingredient::class)->findByExcludedIds($ids);
    }


    public function getRepository()
    {
        // TODO: Implement getRepository() method.
    }
}
