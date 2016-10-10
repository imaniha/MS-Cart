<?php

namespace Rdc\Cart\CartApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class CartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('shop_id', IntegerType::class)
            ->add('channel', TextType::class)
            ->add('status', TextType::class)
            ->add('additional_data', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Rdc\Cart\CartBusinessBundle\Entity\Cart',
                'allow_extra_fields' => true,
                'csrf_protection' => false,
            )
        );
    }

    public function getBlockPrefix()
    {
        return 'cart';
    }
}
