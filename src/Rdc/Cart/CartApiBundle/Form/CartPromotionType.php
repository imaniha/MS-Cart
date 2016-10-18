<?php

namespace Rdc\Cart\CartApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CartPromotionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('promotion', CollectionType::class, ['entry_type' => PromotionType::class, 'allow_add' => true]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'Rdc\Cart\CartBusinessBundle\Entity\Cart',
                'allow_extra_fields' => true,
                'csrf_protection' => false,
            ]
        );
    }

    public function getName()
    {
        return 'cart';
    }
}