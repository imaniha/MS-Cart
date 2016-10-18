<?php

namespace Rdc\Cart\CartBusinessBundle\Vo;

use Symfony\Component\OptionsResolver\OptionsResolver;
/**
 * Behavior
 */
class Behavior extends AbstractVo
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var integer
     */
    private $source;

    /**
     * @var array
     */
    private $target;

    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'type' => '',
                'source' => null,
                'target' => null,
            ]
        );
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param int $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return array
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param array $target
     */
    public function setTarget($target)
    {
        $this->target = $target;
    }



}
