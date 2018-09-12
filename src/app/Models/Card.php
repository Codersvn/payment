<?php

namespace VCComponent\Laravel\Payment\Models;

class Card
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
    public $brand;

    /**
     * @var mixed
     */
    public $last4;

    /**
     * @var mixed
     */
    public $country;

    /**
     * @var mixed
     */
    public $exp_month;

    /**
     * @var mixed
     */
    public $exp_year;

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
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     *
     * @return self
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

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
    public function getExpMonth()
    {
        return $this->exp_month;
    }

    /**
     * @param mixed $exp_month
     *
     * @return self
     */
    public function setExpMonth($exp_month)
    {
        $this->exp_month = $exp_month;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getExpYear()
    {
        return $this->exp_year;
    }

    /**
     * @param mixed $exp_year
     *
     * @return self
     */
    public function setExpYear($exp_year)
    {
        $this->exp_year = $exp_year;

        return $this;
    }
}
