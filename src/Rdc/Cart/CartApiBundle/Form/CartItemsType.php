<?php

namespace Rdc\Cart\CartApiBundle\Form;

use Rdc\Cart\CartApiBundle\Form\ItemType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Count;

class CartItemsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'items',
            CollectionType::class,
            [
                'entry_type' => ItemType::class,
                'allow_add' => true,
                'method' => $options['method'],
                'by_reference' => false,
                'constraints' => new Count(
                    array('min' => 1, 'minMessage' => 'Please post at least one item')
                )
            ]
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