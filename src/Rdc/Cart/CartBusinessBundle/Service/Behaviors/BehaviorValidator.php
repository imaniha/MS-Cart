<?php

namespace Rdc\Cart\CartBusinessBundle\Service\Behaviors;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Rdc\Cart\CartBusinessBundle\Vo\Behavior;
use Rdc\Cart\CartBusinessBundle\Entity\Cart;

class BehaviorValidator
{
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Cart) {
            return;
        }

        if ($args->hasChangedField('behaviors')) {
            $oldValue = $args->getOldValue('behaviors');
            $newValue = $args->getNewValue('behaviors');

        }


    }
}