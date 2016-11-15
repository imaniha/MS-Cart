<?php

namespace Rdc\Cart\CartBusinessBundle\Exception;

use Monolog\Logger;
use Rdc\Mid\RdcMidBundle\Exception\DefaultException;
use Rdc\Mid\RdcMidBundle\Exception\ExposableExceptionInterface;


class CartException extends DefaultException implements ExposableExceptionInterface
{
    const CART_NOT_LOCKED  = [11001, 'Cart: {cart_id} should be in "payment_processing" status to be notified', Logger::ERROR ];

}
