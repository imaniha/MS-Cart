<?php

namespace Rdc\Cart\CartApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromotionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'promotion_rule',
                CollectionType::class,
                ['entry_type' => PromotionRuleType::class, 'allow_add' => true]
            )
            ->add('promotion_data', PromotionDataType::class)
            ->add(
                'promotion_action',
                CollectionType::class,
                ['entry_type' => PromotionActionType::class, 'allow_add' => true]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'Rdc\Cart\CartBusinessBundle\Entity\Promotion',
                'allow_extra_fields' => true,
                'csrf_protection' => false,
            ]
        );
    }

    public function getBlockPrefix()
    {
        return 'promotion';
    }
}