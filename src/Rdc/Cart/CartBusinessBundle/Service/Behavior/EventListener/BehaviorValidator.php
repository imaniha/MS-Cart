<?php

namespace Rdc\Cart\CartBusinessBundle\Service\Behavior\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Rdc\Cart\CartBusinessBundle\Vo\Behavior;
use Rdc\Cart\CartBusinessBundle\Entity\Cart;
use Rdc\Cart\CartBusinessBundle\Service\Behavior\Exception\BehaviorException;
use Rdc\Cart\CartBusinessBundle\Service\Behavior\Factory\BehaviorValidatorFactory;


class BehaviorValidator
{
    private $validator;

    private $behaviorValidatorFactory;

    public function __construct(\Symfony\Component\Validator\Validator\RecursiveValidator $validator, BehaviorValidatorFactory $behaviorValidatorFactory)
    {
        $this->validator = $validator;
        $this->behaviorValidatorFactory = $behaviorValidatorFactory;
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
                $behaviorValidator = $this->behaviorValidatorFactory->get($type, $entity);
                $behaviorValidator->validate();
            }
        }

        return;
    }
}
