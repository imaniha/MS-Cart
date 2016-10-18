<?php

namespace Rdc\Cart\CartApiBundle\Form;


use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BehaviorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', TextType::class)
            ->add('source', IntegerType::class)
            ->add('target', TextType::class);
//            ->add(
//            'target',
//            CollectionType::class,
//            array(
//                'entry_type' => IntegerType::class,
//                'allow_add' => true,
//                'by_reference' => false,
//            )
      //  );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'Rdc\Cart\CartBusinessBundle\Vo\Behavior',
                'csrf_protection' => false,
            ]
        );
    }

    public function getBlockPrefix()
    {
        return 'behavior';
    }
}