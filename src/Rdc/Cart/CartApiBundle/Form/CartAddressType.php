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

    /*
     * convert items parameter into a behavior
     * Ex:
     * {
     *   "cart":{
     *     "address": [{
     *       "address_id": 1,
     *       "items": [{"id":1}}],
     *     }]
     *   }
     * }
     * Will be converted into:
     * {
     *   "cart":{
     *     "address": [{
     *       "address_id": 1,
     *       "items": [{
     *         "item_id": 3,
     *         "quantity": 3,
     *        }]
     *     }]
     *   },
     *   "behaviors":{
     *     "billing_address": {
  	 *        "1": {
  	 *		    "type": "billing_address",
  	 *		    "source": 1,
  	 *		    "target": [
  	 *			  3
  	 *		    ]
  	 *	      }
  	 *     }
     *   }
     * }
     *
     */
    public function onPreSubmitData(FormEvent $event)
    {

        $data = $event->getData();
        //handle type = 'shipping_billing_address' => generate 2 addresses of type shipping_address / billing_address
        foreach($data['address'] as &$address){
            if($address['type'] == 'shipping_billing_address'){
                $address['type'] = 'billing_address';
                $newAddress = $address;
                unset($address);
                $newAddress['type'] = 'shipping_address';
            }
        }
        if(isset($newAddress)){
            $data['address'][] = $newAddress;
        }
        unset($address);
        //create behavior
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
