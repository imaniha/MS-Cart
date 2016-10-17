<?php


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


}