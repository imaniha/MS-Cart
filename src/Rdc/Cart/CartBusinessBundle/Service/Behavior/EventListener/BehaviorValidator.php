<?php

namespace Rdc\Cart\CartBusinessBundle\Service\Behavior\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Rdc\Cart\CartBusinessBundle\Vo\Behavior;
use Rdc\Cart\CartBusinessBundle\Entity\Cart;
use Rdc\Cart\CartBusinessBundle\Service\Behavior\Exception\BehaviorException;
use Rdc\Cart\CartBusinessBundle\Service\Behavior\Validator\MultiAddressCartValidator;


class BehaviorValidator
{
    private $validator;

    public function __construct(\Symfony\Component\Validator\Validator\RecursiveValidator $validator)
    {
        $this->validator = $validator;
    }

    public function preUpdate(LifecycleEventArgs $args)
    {

        $entity = $args->getEntity();

        if (!$entity instanceof Cart) {
            return;
        }

        if ($args->hasChangedField('behaviors')) {
            $behaviors = $args->getNewValue('behaviors');
            foreach ($behaviors as $type => $behavior) {
                $validatorClass = 'Rdc\\Cart\\CartBusinessBundle\\Service\\Behavior\Validator\\' . $type . 'Validator';
                $behaviorValidator = new $validatorClass($entity);
                $behaviorValidator->validate();
            }
        }

        return;
    }
}
