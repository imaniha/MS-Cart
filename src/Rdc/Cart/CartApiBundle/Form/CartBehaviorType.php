<?php

namespace Rdc\Cart\CartApiBundle\Form;

use Rdc\Cart\CartApiBundle\Form\BehaviorType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Count;

class CartBehaviorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
            'behaviors',
            CollectionType::class,
            array(
                'entry_type' => BehaviorType::class,
                'allow_add' => true,
                'by_reference' => false,
                'constraints' => new Count(
                    array('min' => 1, 'minMessage' => 'Please post at least one behavior')
                 )
            )
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'Rdc\Cart\CartBusinessBundle\Entity\Cart',
                'csrf_protection' => false,
            ]
        );
    }

    public function getBlockPrefix()
    {
        return 'cart';
    }
}