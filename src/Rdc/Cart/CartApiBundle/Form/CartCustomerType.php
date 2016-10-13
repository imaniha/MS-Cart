<?php

namespace Rdc\Cart\CartApiBundle\Form;

use Rdc\Cart\CartApiBundle\Form\CustomerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CartCustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('customer', CustomerType::class);
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