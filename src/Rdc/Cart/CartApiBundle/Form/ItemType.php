<?php

namespace Rdc\Cart\CartApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('offer_id', IntegerType::class)
            ->add('store_id', IntegerType::class)
            ->add('quantity', IntegerType::class)
            ->add('name', TextType::class)
            ->add('price', IntegerType::class)
            ->add('image', TextType::class)
            ->add('merchant_id', IntegerType::class)
            ->add('merchant_name', TextType::class)
            ->add('brand_id', IntegerType::class)
            ->add('brand_name', TextType::class)
            ->add('attributes', TextType::class)
            ->add('stock', IntegerType::class)
            ->add('managed_stock', CheckboxType::class)
            ->add('product_url', TextType::class)
            ->add('reference', TextType::class)
            ->add('additional_data', TextType::class);

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                $form = $event->getForm();
                $parent = $form->getParent();
                if (null !== $parent && 'PUT' === $parent->getConfig()->getMethod()) {
                    $form->add('item_id', IntegerType::class);
                }
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'Rdc\Cart\CartBusinessBundle\Vo\Item',
                'csrf_protection' => false,
            ]
        );
    }

    public function getBlockPrefix()
    {
        return 'item';
    }


}