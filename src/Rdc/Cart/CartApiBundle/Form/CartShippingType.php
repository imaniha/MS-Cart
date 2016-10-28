<?php

namespace Rdc\Cart\CartApiBundle\Form;

use Rdc\Cart\CartApiBundle\Form\ShippingType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class CartShippingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'shippings',
                CollectionType::class,
                array(
                    'entry_type' => ShippingType::class,
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
                    'by_reference' => false
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
        if (isset($data['shippings'])) {
            foreach($data['shippings'] as $shipping){
                //generate cart shiping item behavior
                if (isset($shipping['items'])) {
                    $items = [];
                    foreach($shipping['items'] as $item){
                        $items[] = $item['id'];
                    }
                    $behaviors[] = ['type' => 'shipping_type_item',
                        'source' => $shipping['type_id'],
                        'target' => $items
                    ];
                }
                //generate cart shipping store behavior
                if (isset($shipping['stores'])) {
                    $stores = [];
                    foreach($shipping['stores'] as $store){
                        $stores[] = $store['id'];
                    }
                    $behaviors[] = ['type' => 'shipping_type_store',
                        'source' => $shipping['type_id'],
                        'target' => $stores
                    ];
                }
            }
            if($behaviors)
                $data['behaviors'] = $behaviors;
            $event->setData($data);
        }
    }
}