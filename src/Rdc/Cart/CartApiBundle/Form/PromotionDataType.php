<?php

namespace Rdc\Cart\CartApiBundle\Form;

use Nelmio\ApiDocBundle\Tests\Fixtures\Form\CollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromotionDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('id')
            ->add('code')
            ->add('from_date')
            ->add('to_date')
            ->add('enable')
            ->add('max_number_uses')
            ->add('max_use_per_customer')
            ->add('domaine_source')
            ->add('financial_source')
            ->add('user_link')
            ->add('action_id')
            ->add('rule_id')
            ->add('pattern_id')
            ->add('creation_date')
            ->add('creation_user_id')
            ->add('modification_date')
            ->add('modification_user_id');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'Rdc\Cart\CartBusinessBundle\Entity\PromotionData',
                'allow_extra_fields' => true,
                'csrf_protection' => false,
            ]
        );
    }

    public function getBlockPrefix()
    {
        return 'promotion_data';
    }
}