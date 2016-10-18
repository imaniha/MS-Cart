<?php

namespace Rdc\Cart\CartBusinessBundle\Vo;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;
use JMS\Serializer\SerializerBuilder;

/**
 * AbstractVo
 */
abstract class AbstractVo
{
    public function __construct(array $options = array())
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        $options = $resolver->resolve($options);

        $accessor = PropertyAccess::createPropertyAccessor();

        foreach ($options as $key => $option) {
            $accessor->setValue($this, $key, $option);
        }
    }

    public function toArray()
    {
        $serializer = SerializerBuilder::create()->build();
        $data = $serializer->toArray($this);

        return $data;
    }

    //set default values
    abstract protected function configureOptions(OptionsResolver $resolver);

}