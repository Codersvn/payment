<?php

namespace VCComponent\Laravel\Payment\Gateways;

interface GatewayInterface
{
    /**
     * Create Customer
     *
     * @param array $data
     * @param $token
     */
    public function createCustomer(array $data, $token);

    /**
     * Retrieve Customer
     *
     * @param $id
     */
    public function retrieveCustomer($id);

    /**
     * List Customers
     *
     * @param $data
     */
    public function listCustomer($data = null);

    /**
     * Update Customer
     *
     * @param array $data
     * @param $id
     */
    public function updateCustomer(array $data, $id);

    /**
     * Delete Customer
     *
     * Delete Customer
     *
     * @param $id
     */
    public function deleteCustomer($id);

    /**
     * Create Charge
     *
     * @param array $data
     */
    public function createCharge(array $data);

    /**
     * Retrieve Charge
     *
     * @param $id
     */
    public function retrieveCharge($id);

    /**
     * List Charge
     *
     * @param $data
     */
    public function listCharge($data = null);

    /**
     * Update Charge
     *
     * @param array $data
     * @param $id
     */
    public function updateCharge(array $data, $id);

    /**
     * Create Subscription
     *
     * @param $customer_id
     * @param $plan_id
     */
    public function createSubscription($customer_id, $plan_id);

    /**
     * Retrieve Subscription
     *
     * @param $id
     */
    public function retrieveSubscription($id);

    /**
     * List Sbuscription
     * 
     * @param $data
     */
    public function listSubscription($data = null);

    /**
     * Update Subscription
     *
     * @param array $data
     */
    public function updateSubscription(array $data, $id);

    /**
     * Cancel Subscription
     *
     * @param $id
     */
    public function cancelSubscription($id);
}
