<?php

namespace Rdc\Cart\CartBusinessBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PromotionAction
 */
class PromotionAction
{
    protected $id;
    protected $name;
    protected $discount_type;
    protected $discount_value;
    protected $apply_on;
    protected $creation_user_id;
    protected $modification_user_id;
    protected $ts_insert;
    protected $ts_last_change;
    protected $target_id;
    protected $target_type;
    protected $target_mode;
    protected $action_id;

    /**
     * PromotionAction constructor.
     */
    public function __construct($data = [])
    {
        if( count($data)> 0 ) {
            $this->id = $data['id'];
            $this->name = $data['name'];
            $this->discount_type = $data['discount_type'];
            $this->discount_value = $data['discount_value'];
            $this->apply_on = $data['apply_on'];
            $this->creation_user_id = $data['creation_user_id'];
            $this->modification_user_id = $data['modification_user_id'];
            $this->ts_insert = $data['ts_insert'];
            $this->ts_last_change = $data['ts_last_change'];
            $this->target_id = $data['target_id'];
            $this->target_type = $data['target_type'];
            $this->target_mode = $data['target_mode'];
            $this->action_id = $data['action_id'];
        }
    }

    public function toArray()
    {
        $data = [];
        $data['id'] = $this->id;
        $data['name'] = $this->name;
        $data['discount_type'] = $this->discount_type;
        $data['discount_value'] = $this->discount_value;
        $data['apply_on'] = $this->apply_on;
        $data['creation_user_id'] = $this->creation_user_id;
        $data['modification_user_id'] = $this->modification_user_id;
        $data['ts_insert'] = $this->ts_insert;
        $data['ts_last_change'] = $this->ts_last_change;
        $data['target_id'] = $this->target_id;
        $data['target_type'] = $this->target_type;
        $data['target_mode'] = $this->target_mode;
        $data['action_id'] = $this->action_id;
        return $data;
    }


    /**
     * @return mixed
     */
    public function getDiscountValue()
    {
        return $this->discount_value;
    }

    /**
     * @param mixed $discount_value
     */
    public function setDiscountValue($discount_value)
    {
        $this->discount_value = $discount_value;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDiscountType()
    {
        return $this->discount_type;
    }

    /**
     * @param mixed $discount_type
     */
    public function setDiscountType($discount_type)
    {
        $this->discount_type = $discount_type;
    }

    /**
     * @return mixed
     */
    public function getApplyOn()
    {
        return $this->apply_on;
    }

    /**
     * @param mixed $apply_on
     */
    public function setApplyOn($apply_on)
    {
        $this->apply_on = $apply_on;
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
    public function getTargetId()
    {
        return $this->target_id;
    }

    /**
     * @param mixed $target_id
     */
    public function setTargetId($target_id)
    {
        $this->target_id = $target_id;
    }

    /**
     * @return mixed
     */
    public function getTargetType()
    {
        return $this->target_type;
    }

    /**
     * @param mixed $target_type
     */
    public function setTargetType($target_type)
    {
        $this->target_type = $target_type;
    }

    /**
     * @return mixed
     */
    public function getTargetMode()
    {
        return $this->target_mode;
    }

    /**
     * @param mixed $target_mode
     */
    public function setTargetMode($target_mode)
    {
        $this->target_mode = $target_mode;
    }

    /**
     * @return mixed
     */
    public function getActionId()
    {
        return $this->action_id;
    }

    /**
     * @param mixed $action_id
     */
    public function setActionId($action_id)
    {
        $this->action_id = $action_id;
    }
}