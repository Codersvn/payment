<?php

namespace VCComponent\Laravel\Payment\Models;

class Subscription
{
    /**
     * @var mixed
     */
    public $id;

    /**
     * @var mixed
     */
    public $plan_id;

    /**
     * @var mixed
     */
    public $customer;

    /**
     * @var mixed
     */
    public $quantity;

    /**
     * @var mixed
     */
    public $status;

    /**
     * @var mixed
     */
    public $trial_end;

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
    public function getPlanId()
    {
        return $this->plan_id;
    }

    /**
     * @param mixed $plan_id
     *
     * @return self
     */
    public function setPlanId($plan_id)
    {
        $this->plan_id = $plan_id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param mixed $customer
     *
     * @return self
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     *
     * @return self
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTrialEnd()
    {
        return $this->trial_end;
    }

    /**
     * @param mixed $trial_end
     *
     * @return self
     */
    public function setTrialEnd($trial_end)
    {
        $this->trial_end = $trial_end;

        return $this;
    }
}
