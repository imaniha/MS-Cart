<?php

namespace Rdc\Cart\CartApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromotionRuleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('site_id')
            ->add('threshold_amount')
            ->add('creation_user_id')
            ->add('modification_user_id')
            ->add('ts_insert')
            ->add('ts_last_change')
            ->add('store_mode');

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'Rdc\Cart\CartBusinessBundle\Entity\PromotionRule',
                'allow_extra_fields' => true,
                'csrf_protection' => false,
            ]
        );
    }

    public function getBlockPrefix()
    {
        return 'promotion_rule';
    }
}