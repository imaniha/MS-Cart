<?php

namespace Rdc\Cart\CartApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ShippingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type_id', IntegerType::class)
            ->add('type_name', TextType::class)
            ->add('additional_data', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'Rdc\Cart\CartBusinessBundle\Vo\Shipping',
                'csrf_protection' => false,
                'error_bubbling' => false,
            ]
        );
    }

    public function getBlockPrefix()
    {
        return 'payment';
    }
}