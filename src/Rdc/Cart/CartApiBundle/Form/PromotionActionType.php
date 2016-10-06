<?php

namespace Rdc\Cart\CartApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromotionActionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('id')
        ->add('name')
        ->add('discount_type')
        ->add('discount_value')
        ->add('apply_on')
        ->add('creation_user_id')
        ->add('modification_user_id')
        ->add('ts_insert')
        ->add('ts_last_change')
        ->add('target_id')
        ->add('target_type')
        ->add('target_mode')
        ->add('action_id');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Rdc\Cart\CartBusinessBundle\Entity\PromotionAction',
            'allow_extra_fields' => true,
            'csrf_protection' => false
        ));
    }

    public function getBlockPrefix()
    {
        return 'promotion_action';
    }
}