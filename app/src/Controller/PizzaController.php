<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Entity\PizzaIngredient;
use App\Form\AddNewIngredientType;
use App\Form\PizzaType;
use App\Services\PizzaService;
use AppBundle\Provider\Model\MessageList;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Pizza controller.
 * @Route("/")
 */
class PizzaController extends AbstractController
{
    /**
     * Lists all Pizza entities.
     *
     * @Route("/list", name="pizza_list",methods={"GET"})
     *
     * @param PizzaService $pizzaService
     *
     * @return Response
     */
    public function indexAction(PizzaService $pizzaService): Response
    {
        $pizzas = $pizzaService->getAll();

        return $this->render(
            'list.html.twig',
            [
                'pizzas' => $pizzas,
            ]
        );
    }

    /**
     * Displays a form to edit an existing Pizza entity.
     *
     * @Route("/{id}/edit", name="pizza_edit")
     * @ParamConverter("pizza", class=Pizza::class, options={"mapping":{"id": "id"}})
     * @param Request $request
     * @param Pizza $pizza
     * @param PizzaService $pizzaService
     *
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, Pizza $pizza, PizzaService $pizzaService)
    {
        $pizzaIngredientIds = [];
        $ingredients = [];
        $editForm = $this->createForm(PizzaType::class, $pizza);
        $editForm->handleRequest($request);

        foreach ($pizza->getPizzaIngredients() as $ingredient) {
            $pizzaIngredientIds[] = $ingredient->getIngredient()->getId();
        }

        $ingredientsToAdd = $pizzaService->getIngredientsToAdd($pizzaIngredientIds);

        foreach ($ingredientsToAdd as $ingredient) {
            $ingredients[$ingredient->getName()] = $ingredient->getId();
        }

        $addNewIngredientForm = $this->createForm(
            AddNewIngredientType::class,
            [
                'ingredients' => $ingredients,
                'method' => 'POST',
                'pizzaId' => $pizza->getId(),
                'action' => $this->generateUrl('pizza_ingredient_add'),
            ]
        );

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $pizzaService->update();

            return $this->redirectToRoute('pizza_edit', ['id' => $pizza->getId()]);
        }

        return $this->render(
            'edit.html.twig',
            [
                'pizza' => $pizza,
                'edit_form' => $editForm->createView(),
                'addNewIngredientForm' => $addNewIngredientForm->createView(),
                'addIngredientURL' => $this->generateUrl('pizza_ingredient_add'),
            ]
        );
    }

    /**
     * Displays a form to delete a pizza ingredient.
     *
     * @Route("/{id}/delete-ingredient", name="pizza_ingredient_delete")
     * @ParamConverter("pizzaIngredient", class=PizzaIngredient::class, options={"mapping":{"id": "id"}})
     * @param Request $request
     * @param PizzaIngredient $pizzaIngredient
     * @param PizzaService $pizzaService
     *
     * @return JsonResponse
     */
    public function deleteIngredientAction(Request $request, PizzaIngredient $pizzaIngredient, PizzaService $pizzaService): JsonResponse
    {
        $pizzaService->deletePizzaIngredient($pizzaIngredient);

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     *
     * @Route("/add-ingredient", name="pizza_ingredient_add")
     * @param Request $request
     * @param PizzaService $pizzaService
     *
     * @return RedirectResponse|Response
     */
    public function addIngredientAction(Request $request, PizzaService $pizzaService)
    {
        $pizza = $pizzaService->findOneById(
            $request->request->get('new_pizza_ingredient')['pizzaId']
        );
        $ingredient = $pizzaService->getIngredientRepository()->findOneById(
            $request->request->get('new_pizza_ingredient')['IngredientId']
        );

        $pizzaIngredient = new PizzaIngredient();
        $pizzaIngredient->setPizza($pizza);
        $pizzaIngredient->setIngredient($ingredient);
        $pizzaService->getEntityManager()->persist($pizzaIngredient);
        $pizzaService->getEntityManager()->flush();

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     *
     * @Route("/update-ingredient-position", name="pizza_ingredient_update_position")
     * @param Request $request
     * @param PizzaService $pizzaService
     *
     * @return RedirectResponse|Response
     */
    public function updateIngredientPositionAction(Request $request, PizzaService $pizzaService)
    {
        $ingredientId = $request->get('pizzaIngredientId');
        $position = $request->get('position');

        try {
            $pizzaService->updatePizzaIngredientPosition($ingredientId, $position);

            return new jsonresponse(true);
        } catch (Exception $e) {
            return new jsonresponse(false);
        }
    }
}
