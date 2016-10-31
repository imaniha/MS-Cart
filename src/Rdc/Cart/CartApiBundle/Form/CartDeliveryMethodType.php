<?php

namespace Rdc\Cart\CartApiBundle\Form;

use Rdc\Cart\CartApiBundle\Form\DeliveryMethodType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class CartDeliveryMethodType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'delivery_methods',
                CollectionType::class,
                array(
                    'entry_type' => DeliveryMethodType::class,
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
        if (isset($data['delivery_methods'])) {
            foreach($data['delivery_methods'] as $deliverymethod){
                //generate cart delivery method item behavior
                if (isset($deliverymethod['items'])) {
                    $items = [];
                    foreach($deliverymethod['items'] as $item){
                        $items[] = $item['id'];
                    }
                    $behaviors[] = ['type' => 'delivery_method_item',
                        'source' => $deliverymethod['type_id'],
                        'target' => $items
                    ];
                }
                //generate cart delivery method store behavior
                if (isset($deliverymethod['stores'])) {
                    $stores = [];
                    foreach($deliverymethod['stores'] as $store){
                        $stores[] = $store['id'];
                    }
                    $behaviors[] = ['type' => 'delivery_method_store',
                        'source' => $deliverymethod['type_id'],
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