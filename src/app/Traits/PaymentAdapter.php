<?php

namespace VCComponent\Laravel\Payment\Traits;

use Illuminate\Support\Facades\App;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use VCComponent\Laravel\Payment\Entities\Payment;
use VCComponent\Laravel\Payment\Gateways\GatewayInterface;

trait PaymentAdapter
{
    /**
     * Get the customers for the user
     *
     * @return mixed
     */
    public function customers()
    {
        return $this->hasMany(config('payment.models.customer'));
    }

    /**
     * Get the customers for the user
     *
     * @return mixed
     */
    public function payments()
    {
        return $this->hasMany(config('payment.models.payment'));
    }

    /**
     * Make new Gateway
     *
     * @return mixed
     */
    public function makeGateway()
    {
        $gateway = App::make(GatewayInterface::class);
        return $gateway;
    }

    /**
     * Create customer
     *
     * @param $token
     * @return mixed
     */
    public function createCustomer($token)
    {
        $gateway = $this->makeGateway();

        $data = [
            'email' => $this->email,
        ];
        $customer = $gateway->createCustomer($data, $token);

        return $customer;
    }

    /**
     * Save customer to customers table
     *
     * @param $customer
     * @return mixed
     */
    public function saveCustomer($customer)
    {
        $data     = $this->transformCustomer($customer);
        $customer = $this->customers()->create($data);

        return $customer;
    }

    /**
     * Retrieve customer
     *
     * @param $customer_id
     * @return mixed
     */
    public function retrieveCustomer($customer_id)
    {
        $gateway  = $this->makeGateway();
        $customer = $gateway->retrieveCustomer($customer_id);

        return $customer;
    }

    /**
     * List all customer
     *
     * @return mixed
     */
    public function listCustomer($data = null)
    {
        $gateway   = $this->makeGateway();
        $customers = $gateway->listCustomer($data);

        return $customers;
    }

    /**
     * Update Customer
     *
     * @param $data
     * @param $customer_id
     * @return mixed
     */
    public function updateCustomer($data, $customer_id)
    {
        $gateway   = $this->makeGateway();
        $customers = $gateway->updateCustomer($data, $customer_id);

        return $customers;
    }

    /**
     * Update customer changes to customers table
     *
     * @param $customer
     * @return mixed
     */
    public function updateCustomerChanges($customer)
    {
        $data = $this->transformCustomer($customer);

        $query    = App::make(config('payment.models.customer'))->where('customer_id', $data['customer_id']);
        $customer = $query->first();

        if (!$customer) {
            throw new BadRequestHttpException();
        }

        $customer->update($data);
        $customer = $query->first();

        return $customer;
    }

    /**
     * Delete Customer
     *
     * @param $id
     * @return mixed
     */
    public function deleteCustomer($id)
    {
        $gateway = $this->makeGateway();

        return $gateway->deleteCustomer($id);
    }

    /**
     * Transform Customer object
     *
     * @param $customer
     */
    public function transformCustomer($customer)
    {
        return [
            'customer_id'       => $customer->id,
            'card_id'           => $customer->sources[0]->id,
            'card_brand'        => $customer->sources[0]->brand,
            'card_country'      => $customer->sources[0]->country,
            'card_number'       => $customer->sources[0]->last4,
            'card_expired_date' => $customer->sources[0]->exp_month . '/' . $customer->sources[0]->exp_year,
        ];
    }

    /**
     * Create Charge
     *
     * @param $amount
     * @param $source
     * @param null $currency
     * @return mixed
     */
    public function createCharge($amount, $source = null, $currency = 'usd')
    {
        $gateway = $this->makeGateway();

        $data = [
            'amount'   => $amount,
            'currency' => $currency,
        ];

        $customer = App::make(config('payment.models.customer'));
        if ($source instanceof $customer) {

            $data['customer'] = $source->customer_id;

        } elseif (is_null($source)) {

            if ($this->customers->count() == 0) {
                throw new BadRequestHttpException();
            }

            $data['customer'] = $this->customers->first()->customer_id;

        } else {

            $data['source'] = $source;

        }

        $charge = $gateway->createCharge($data);

        return $charge;
    }

    /**
     * Save charge to payments table
     *
     * @param $charge
     * @return mixed
     */
    public function savePayment($charge)
    {
        $data            = collect($this->transformCharge($charge));
        $charge_customer = $data->pull('customer');
        $data            = $data->toArray();

        if ($charge_customer !== null) {
            $customer = $this->customers->first();
            $payment  = $customer->payments()->create($data);
            $payment->user()->associate($this);
            $payment->save();
        } else {
            $payment = $this->payments()->create($data);
        }

        return $payment;
    }

    /**
     * Transform Charge object
     *
     * @param $charge
     */
    public function transformCharge($charge)
    {
        return [
            'charge_id'   => $charge->id,
            'card_id'     => $charge->source->id,
            'amount'      => $charge->amount,
            'currency'    => $charge->currency,
            'description' => $charge->description,
            'destination' => $charge->destination,
            'customer'    => $charge->customer,
        ];
    }

    /**
     * Retrieve Charge
     *
     * @param $charge_id
     * @return mixed
     */
    public function retrieveCharge($charge_id)
    {
        $gateway = $this->makeGateway();
        $charge  = $gateway->retrieveCharge($charge_id);

        return $charge;
    }

    /**
     * List Charge
     *
     * @param $data
     * @return mixed
     */
    public function listCharge($data = null)
    {
        $gateway = $this->makeGateway();
        $charges = $gateway->listCharge($data);

        return $charges;
    }

    /**
     * Update Charge
     *
     * @param $data
     * @param $charge_id
     * @return mixed
     */
    public function updateCharge($data, $charge_id)
    {
        $gateway = $this->makeGateway();
        $charge  = $gateway->updateCharge($data, $charge_id);

        return $charge;
    }

    /**
     * Update payment changes to payments table
     *
     * @param $charge
     * @return mixed
     */
    public function updatePaymentChanges($charge)
    {
        $data            = collect($this->transformCharge($charge));
        $charge_customer = $data->pull('customer');
        $data            = $data->toArray();

        $query   = App::make(config('payment.models.payment'))->where('charge_id', $data['charge_id']);
        $payment = $query->first();
        if (!$payment) {
            throw new BadRequestHttpException();
        }

        $payment->update($data);
        $payment = $query->first();

        return $payment;
    }

    /**
     * Create Subscription
     *
     * @param $plan_id
     * @return mixed
     */
    public function createSubscription($plan_id)
    {
        $gateway  = $this->makeGateway();
        $customer = $this->customers->first();
        if (!$customer) {
            throw new BadRequestHttpException();
        }
        $subscription = $gateway->createSubscription($customer->customer_id, $plan_id);

        return $subscription;
    }

    /**
     * Transform Subscription
     *
     * @param $subscription
     */
    public function transformSubscription($subscription)
    {
        return [
            'customer_id'     => $subscription->customer,
            'subscription_id' => $subscription->id,
            'plan_id'         => $subscription->plan_id,
            'quantity'        => $subscription->quantity,
            'status'          => $subscription->status,
            'trial_end'       => $subscription->trial_end,
        ];
    }

    /**
     * Save Subscription to subscriptions table
     *
     * @param $subscription
     * @return mixed
     */
    public function saveSubscription($subscription)
    {
        $data        = collect($this->transformSubscription($subscription));
        $customer_id = $data->pull('customer_id');
        $data        = $data->toArray();

        $customer = $this->customers->where('customer_id', $customer_id)->first();
        if (!$customer) {
            throw new BadRequestHttpException();
        }
        $subscription = $customer->subscriptions()->create($data);

        return $subscription;
    }

    /**
     * Cancel Subscription
     *
     * @param $subscription_id
     * @return mixed
     */
    public function cancelSubscription($subscription_id)
    {
        $gateway      = $this->makeGateway();
        $subscription = $gateway->cancelSubscription($subscription_id);

        return $subscription;
    }

    /**
     * Update Subscription
     *
     * @param $data
     * @param $subscription_id
     * @return mixed
     */
    public function updateSubscription($data, $subscription_id)
    {
        $gateway      = $this->makeGateway();
        $subscription = $gateway->updateSubscription($data, $subscription_id);

        return $subscription;
    }
}
