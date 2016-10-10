<?php

namespace Rdc\Cart\CartBusinessBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PromotionData
 */
class PromotionData
{
    protected $id;
    protected $code;
    protected $from_date;
    protected $to_date;
    protected $enable;
    protected $max_number_uses;
    protected $max_use_per_customer;
    protected $domaine_source;
    protected $financial_source;
    protected $user_link;
    protected $action_id;
    protected $rule_id;
    protected $pattern_id;
    protected $creation_date;
    protected $creation_user_id;
    protected $modification_date;
    protected $modification_user_id;

    /**
     * @param $data
     */
    public function __construct($data = [])
    {
        if( count($data)> 0 ){
            $this->id = $data['id'];
            $this->code = $data['code'];
            $this->from_date = $data['from_date'];
            $this->to_date = $data['to_date'];
            $this->enable = $data['enable'];
            $this->max_number_uses = $data['max_number_uses'];
            $this->max_use_per_customer = $data['max_use_per_customer'];
            $this->domaine_source = $data['domaine_source'];
            $this->financial_source = $data['financial_source'];
            $this->user_link = $data['user_link'];
            $this->action_id = $data['action_id'];
            $this->rule_id = $data['rule_id'];
            $this->pattern_id = $data['pattern_id'];
            $this->creation_date = $data['creation_date'];
            $this->creation_user_id = $data['creation_user_id'];
            $this->modification_date = $data['modification_date'];
            $this->modification_user_id = $data['modification_user_id'];
        }
    }

    public function toArray(){
        $return = [];
        $return['id'] = $this->id;
        $return['code'] = $this->code;
        $return['from_date'] = $this->from_date;
        $return['to_date'] = $this->to_date;
        $return['enable'] = $this->enable;
        $return['max_number_uses'] = $this->max_number_uses;
        $return['max_use_per_customer'] = $this->max_use_per_customer;
        $return['domaine_source'] = $this->domaine_source;
        $return['financial_source'] = $this->financial_source;
        $return['user_link'] = $this->user_link;
        $return['action_id'] = $this->action_id;
        $return['rule_id'] = $this->rule_id;
        $return['pattern_id'] = $this->pattern_id;
        $return['creation_date'] = $this->creation_date;
        $return['creation_user_id'] = $this->creation_user_id;
        $return['modification_date'] = $this->modification_date;
        $return['modification_user_id'] = $this->modification_user_id;
        return $return;
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
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getFromDate()
    {
        return $this->from_date;
    }

    /**
     * @param mixed $from_date
     */
    public function setFromDate($from_date)
    {
        $this->from_date = $from_date;
    }

    /**
     * @return mixed
     */
    public function getToDate()
    {
        return $this->to_date;
    }

    /**
     * @param mixed $to_date
     */
    public function setToDate($to_date)
    {
        $this->to_date = $to_date;
    }

    /**
     * @return mixed
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * @param mixed $enable
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;
    }

    /**
     * @return mixed
     */
    public function getMaxNumberUses()
    {
        return $this->max_number_uses;
    }

    /**
     * @param mixed $max_number_uses
     */
    public function setMaxNumberUses($max_number_uses)
    {
        $this->max_number_uses = $max_number_uses;
    }

    /**
     * @return mixed
     */
    public function getMaxUsePerCustomer()
    {
        return $this->max_use_per_customer;
    }

    /**
     * @param mixed $max_use_per_customer
     */
    public function setMaxUsePerCustomer($max_use_per_customer)
    {
        $this->max_use_per_customer = $max_use_per_customer;
    }

    /**
     * @return mixed
     */
    public function getDomaineSource()
    {
        return $this->domaine_source;
    }

    /**
     * @param mixed $domaine_source
     */
    public function setDomaineSource($domaine_source)
    {
        $this->domaine_source = $domaine_source;
    }

    /**
     * @return mixed
     */
    public function getFinancialSource()
    {
        return $this->financial_source;
    }

    /**
     * @param mixed $financial_source
     */
    public function setFinancialSource($financial_source)
    {
        $this->financial_source = $financial_source;
    }

    /**
     * @return mixed
     */
    public function getUserLink()
    {
        return $this->user_link;
    }

    /**
     * @param mixed $user_link
     */
    public function setUserLink($user_link)
    {
        $this->user_link = $user_link;
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

    /**
     * @return mixed
     */
    public function getRuleId()
    {
        return $this->rule_id;
    }

    /**
     * @param mixed $rule_id
     */
    public function setRuleId($rule_id)
    {
        $this->rule_id = $rule_id;
    }

    /**
     * @return mixed
     */
    public function getPatternId()
    {
        return $this->pattern_id;
    }

    /**
     * @param mixed $pattern_id
     */
    public function setPatternId($pattern_id)
    {
        $this->pattern_id = $pattern_id;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creation_date;
    }

    /**
     * @param mixed $creation_date
     */
    public function setCreationDate($creation_date)
    {
        $this->creation_date = $creation_date;
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
    public function getModificationDate()
    {
        return $this->modification_date;
    }

    /**
     * @param mixed $modification_date
     */
    public function setModificationDate($modification_date)
    {
        $this->modification_date = $modification_date;
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


}