<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AddNewIngredientType
 * @package App\Form
 */
class AddNewIngredientType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        // dump(            $options['data']['ingredients']);die();
        $builder->add(
            'IngredientId',
            ChoiceType::class,
            [
                'label' => "Ingredient ",
                'multiple' => false,
                'mapped' => false,
                'placeholder' => false,
                'choices' =>  $options['data']['ingredients']
                ]
            ) ->add(
            'pizzaId',
            HiddenType::class,
            [
                'data' => $options['data']['pizzaId'],
            ]
        )->add(
            'Add',
            SubmitType::class,
            [
                'label' => ''
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
     //   $resolver->setDefaults(['postedBy' => null]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'new_pizza_ingredient';
    }
}
