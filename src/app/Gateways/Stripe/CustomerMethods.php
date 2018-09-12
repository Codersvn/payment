<?php

namespace VCComponent\Laravel\Payment\Gateways\Stripe;

use Stripe\Customer as StripeCustomer;

trait CustomerMethods
{
    /**
     * Create Customer Source
     *
     * @param $customer
     * @param $token
     * @return mixed
     */
    private function createCustomerSource($customer, $token)
    {
        $source = $customer->sources->create([
            'source' => $token,
        ]);

        return $source;
    }

    /**
     * Retrieve raw Stripe Customer
     *
     * @param $id
     * @return mixed
     */
    private function retrieveRawStripeCustomer($id)
    {
        $customer = StripeCustomer::retrieve($id);
        return $customer;
    }

    /**
     * Create Customer
     *
     * @param array $data
     * @return mixed
     */
    public function createCustomer(array $data, $token)
    {
        $data['source'] = $token;
        $result         = StripeCustomer::create($data);
        $customer       = $this->mapResultToCustomer($result);

        return $customer;
    }

    /**
     * Retrieve Customer
     *
     * @param mixed $id
     */
    public function retrieveCustomer($id)
    {
        $result   = $this->retrieveRawStripeCustomer($id);
        $customer = $this->mapResultToCustomer($result);

        return $customer;
    }

    /**
     * List all customers
     */
    public function listCustomer($data = null)
    {
        $result = StripeCustomer::all($data);
        $arr    = [];

        if (count($result->data)) {
            foreach ($result->data as $item) {
                $arr[] = $this->mapResultToCustomer($item);
            }
            $customers = collect($arr);
        }

        return $customers;
    }

    /**
     * Update Customer
     *
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function updateCustomer(array $data, $id)
    {
        $result = $this->retrieveRawStripeCustomer($id);

        if (count($data)) {
            foreach ($data as $key => $value) {
                $result->$key = $value;
            }
            $result->save();
        }

        $customer = $this->mapResultToCustomer($result);

        return $customer;
    }

    /**
     * Delete Customer
     *
     * @param $id
     */
    public function deleteCustomer($id)
    {
        $result = $this->retrieveRawStripeCustomer($id)->delete();

        if ($result->deleted == true) {
            return true;
        }

        return false;
    }
}
