<?php

namespace Rdc\Cart\CartBusinessBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Promotion
 */
class Promotion
{
    /**
     * @var array
     */
    protected $promotionRule = [];

    /**
     * @var PromotionData
     */
    protected $promotionData;

    /**
     * @var array
     */
    protected $promotionAction = [];

    /**
     * @param $data
     */
    public function __construct($data = [])
    {
//        dump($data);die;
//        $this->setPromotionRule($data['promotion_rule']);
//        $this->setPromotionData($data['promotion_data']);
//        $this->setPromotionAction($data['promotion_action']);
    }

    /**
     * @return array
     */
    public function getPromotionRule()
    {
        $return = [];
        foreach( $this->promotionRule as $promoRule ){
            $return[] = new PromotionRule($promoRule);

        }
        return $return;
    }

    /**
     * @param array $promotionRule
     */
    public function setPromotionRule($promotionRule)
    {
        foreach( $promotionRule as $promoRule ){
            $this->promotionRule[] = $promoRule->toArray();
        }
    }


    public function getPromotionAction()
    {
        $return = [];
        foreach( $this->promotionAction as $promoAction ){
            $return[] = new PromotionAction($promoAction);
        }
        return $return;
    }


    public function setPromotionAction($promotionAction)
    {
        foreach( $promotionAction as $promoAction ){
            $this->promotionAction[] = $promoAction->toArray();
        }
    }


    public function getPromotionData()
    {
        return new PromotionData($this->promotionData);

    }

    public function setPromotionData($promotionData)
    {
        return $this->promotionData = $promotionData->toArray();
    }

    public function toArray(){
//        dump($this->promotionData);die;

        return [
            'promotion_rule' => $this->promotionRule,
            'promotion_data' => $this->promotionData,
            'promotion_action' => $this->promotionAction,
        ];
    }
}
