<?php

namespace Rdc\Cart\CartApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address_id', IntegerType::class)
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('address1', TextType::class)
            ->add('address2', TextType::class)
            ->add('city', TextType::class)
            ->add('zip', TextType::class)
            ->add('country_code', TextType::class)
            ->add('country_label', TextType::class)
            ->add('phone', TextType::class)
            ->add('mobile_phone', TextType::class)
            ->add('work_phone', TextType::class)
            ->add('fax', TextType::class)
            ->add('rcs', TextType::class)
            ->add('access_code', TextType::class)
            ->add('additional_data', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'Rdc\Cart\CartBusinessBundle\Entity\Address',
                'csrf_protection' => false,
            ]
        );
    }

    public function getBlockPrefix()
    {

        return 'address';
    }
}
