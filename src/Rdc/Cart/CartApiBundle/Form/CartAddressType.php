<?php

namespace Rdc\Cart\CartApiBundle\Form;

use Rdc\Cart\CartApiBundle\Form\AddressType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class CartAddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'address',
                CollectionType::class,
                array(
                    'entry_type' => AddressType::class,
                    'allow_add' => true,
                    'by_reference' => false,
                )
            )
            ->add(
                'behaviors',
                CollectionType::class,
                array(
                    'entry_type' => BehaviorType::class,
                    'allow_add' => true,
                    'by_reference' => false,
                )
            )
            ->addEventListener(
                FormEvents::PRE_SUBMIT,
                array($this, 'onPreSubmitData')
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'Rdc\Cart\CartBusinessBundle\Entity\Cart',
                'csrf_protection' => false,
            ]
        );
    }

    public function getBlockPrefix()
    {
        return 'cart';
    }

    public function onPreSubmitData(FormEvent $event)
    {
        $data = $event->getData();
        $behaviors = [];
        if (isset($data['address'])) {
            foreach($data['address'] as $address){
                $items = [];
                if (isset($address['items'])) {
                    foreach($address['items'] as $item){
                        $items[] = $item['id'];
                    }
                }
                $behaviors[] = ['type' => $address['type'],
                    'source' => $address['address_id'],
                    'target' => $items
                ];
                $data['behaviors'] = $behaviors;
            }
            $event->setData($data);
        }
    }
}