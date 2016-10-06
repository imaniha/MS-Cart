<?php

namespace Rdc\Cart\CartBusinessBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PromotionRule
 */
class PromotionRule
{
    protected $site_id;
    protected $threshold_amount;
    protected $creation_user_id;
    protected $modification_user_id;
    protected $ts_insert;
    protected $ts_last_change;
    protected $store_mode;



    /**
     * PromotionRule constructor.
     */
    public function __construct($data = [])
    {
        if( count($data)> 0 ) {
            $this->site_id = $data['site_id'];
            $this->threshold_amount = $data['threshold_amount'];
            $this->creation_user_id = $data['creation_user_id'];
            $this->modification_user_id = $data['modification_user_id'];
            $this->ts_insert = $data['ts_insert'];
            $this->ts_last_change = $data['ts_last_change'];
            $this->store_mode = $data['store_mode'];
        }
    }

    public function toArray(){
        $data = [];
        $data['site_id'] = $this->site_id;
        $data['threshold_amount'] = $this->threshold_amount;
        $data['creation_user_id'] = $this->creation_user_id;
        $data['modification_user_id'] = $this->modification_user_id;
        $data['ts_insert'] = $this->ts_insert;
        $data['ts_last_change'] = $this->ts_last_change;
        $data['store_mode'] = $this->store_mode;
        return $data;
    }


    /**
     * @return mixed
     */
    public function getSiteId()
    {
        return $this->site_id;
    }

    /**
     * @param mixed $site_id
     */
    public function setSiteId($site_id)
    {
        $this->site_id = $site_id;
    }

    /**
     * @return mixed
     */
    public function getThresholdAmount()
    {
        return $this->threshold_amount;
    }

    /**
     * @param mixed $threshold_amount
     */
    public function setThresholdAmount($threshold_amount)
    {
        $this->threshold_amount = $threshold_amount;
    }

    /**
     * @return mixed
     */
    public function getCreationUserId()
    {
        return $this->creation_user_id;
    }

    /**
     * @param mixed $creation_user_id
     */
    public function setCreationUserId($creation_user_id)
    {
        $this->creation_user_id = $creation_user_id;
    }

    /**
     * @return mixed
     */
    public function getModificationUserId()
    {
        return $this->modification_user_id;
    }

    /**
     * @param mixed $modification_user_id
     */
    public function setModificationUserId($modification_user_id)
    {
        $this->modification_user_id = $modification_user_id;
    }

    /**
     * @return mixed
     */
    public function getTsInsert()
    {
        return $this->ts_insert;
    }

    /**
     * @param mixed $ts_insert
     */
    public function setTsInsert($ts_insert)
    {
        $this->ts_insert = $ts_insert;
    }

    /**
     * @return mixed
     */
    public function getTsLastChange()
    {
        return $this->ts_last_change;
    }

    /**
     * @param mixed $ts_last_change
     */
    public function setTsLastChange($ts_last_change)
    {
        $this->ts_last_change = $ts_last_change;
    }

    /**
     * @return mixed
     */
    public function getStoreMode()
    {
        return $this->store_mode;
    }

    /**
     * @param mixed $store_mode
     */
    public function setStoreMode($store_mode)
    {
        $this->store_mode = $store_mode;
    }


}