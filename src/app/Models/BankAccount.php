<?php

namespace VCComponent\Laravel\Payment\Models;

class BankAccount
{
    /**
     * @var mixed
     */
    public $id;

    /**
     * @var mixed
     */
    public $type;

    /**
     * @var mixed
     */
    public $account_holder_name;

    /**
     * @var mixed
     */
    public $account_holder_type;

    /**
     * @var mixed
     */
    public $country;

    /**
     * @var mixed
     */
    public $currency;

    /**
     * @var mixed
     */
    public $last4;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     *
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAccountHolderName()
    {
        return $this->account_holder_name;
    }

    /**
     * @param mixed $account_holder_name
     *
     * @return self
     */
    public function setAccountHolderName($account_holder_name)
    {
        $this->account_holder_name = $account_holder_name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAccountHolderType()
    {
        return $this->account_holder_type;
    }

    /**
     * @param mixed $account_holder_type
     *
     * @return self
     */
    public function setAccountHolderType($account_holder_type)
    {
        $this->account_holder_type = $account_holder_type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     *
     * @return self
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     *
     * @return self
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLast4()
    {
        return $this->last4;
    }

    /**
     * @param mixed $last4
     *
     * @return self
     */
    public function setLast4($last4)
    {
        $this->last4 = $last4;

        return $this;
    }
}
