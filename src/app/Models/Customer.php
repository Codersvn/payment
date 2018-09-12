<?php

namespace VCComponent\Laravel\Payment\Models;

class Customer
{
    /**
     * @var mixed
     */
    public $id;

    /**
     * @var mixed
     */
    public $email;

    /**
     * @var array
     */
    public $sources = [];

    /**
     * @param $id
     * @return mixed
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $email
     * @return mixed
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $source
     * @return mixed
     */
    public function setSources($sources)
    {
        if (is_array($sources)) {
            $this->sources = $sources;
        } else {
            $this->sources[] = $sources;
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSources()
    {
        return $this->sources;
    }
}
