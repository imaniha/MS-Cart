<?php
namespace Rdc\Cart\CartBusinessBundle\Service\Behaviors;

Abstract class AbstractCartBehavior
{
    /**
     * @var string
     */
    private $type;

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }


    public function setType()
    {
        $this->type = get_class($this);
    }

    abstract function validate();


}