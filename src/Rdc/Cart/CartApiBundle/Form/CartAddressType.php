<?php

namespace Rdc\Cart\CartApiBundle\Form;

use Rdc\Cart\CartApiBundle\Form\AddressType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CartAddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address', AddressType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Rdc\Cart\CartBusinessBundle\Entity\Cart',
                'csrf_protection' => false,
            )
        );
    }

    public function getBlockPrefix()
    {
        return 'cart';
    }
}