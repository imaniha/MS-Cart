<?php

namespace Rdc\Cart\CartBusinessBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * BusinessRepository
 */
class BusinessRepository extends EntityRepository
{
    public function createEntity($data = []){

        $default = [];
        $data = array_merge($default, $data);
        $entity = new $this->_entityName;

        return $entity;
    }
}
