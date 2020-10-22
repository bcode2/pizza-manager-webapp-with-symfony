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
        $builder->add(
            'IngredientId',
            ChoiceType::class,
            [
                'label' => ".",
                'multiple' => false,
                'mapped' => false,
                'placeholder' => false,
                'choices' => $options['data']['ingredients'],
                'attr' => [
                    'style' => 'display:inline-block',
                ],
            ]
        )->add(
            'pizzaId',
            HiddenType::class,
            [
                'data' => $options['data']['pizzaId'],
            ]
        )->add(
            'Add',
            SubmitType::class,
            [
                'label' => 'Add',
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'new_pizza_ingredient';
    }
}
