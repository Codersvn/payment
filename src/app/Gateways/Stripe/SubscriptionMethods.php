<?php

namespace VCComponent\Laravel\Payment\Gateways\Stripe;

use Stripe\Subscription as StripeSubscription;

trait SubscriptionMethods
{
    /**
     * Create Subscription
     *
     * @param $id
     * @return mixed
     */
    public function retrieveRawStripeSubscription($id)
    {
        $subscription = StripeSubscription::retrieve($id);
        return $subscription;
    }

    /**
     * Create Subscription
     *
     * @param $customer_id
     * @param $plan_id
     * @return mixed
     */
    public function createSubscription($customer_id, $plan_id)
    {
        $data = [
            'customer' => $customer_id,
            'items'    => [
                [
                    'plan' => $plan_id,
                ],
            ],
        ];
        $result       = StripeSubscription::create($data);
        $subscription = $this->mapResultToSubscription($result);

        return $subscription;
    }

    /**
     * Retrieve Subscription
     *
     * @param $id
     * @return mixed
     */
    public function retrieveSubscription($id)
    {
        $result       = $this->retrieveRawStripeSubscription($id);
        $subscription = $this->mapResultToSubscription($result);

        return $subscription;
    }

    /**
     * List Subscription
     * 
     * @param $data
     * @return mixed
     */
    public function listSubscription($data = null)
    {
        $result = StripeSubscription::all($data);
        $arr    = [];

        if (count($result->data)) {
            foreach ($result->data as $item) {
                $arr[] = $this->mapResultToSubscription($item);
            }
            $subscriptions = collect($arr);
        }

        return $subscriptions;
    }

    /**
     * Update Subscription
     * 
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function updateSubscription(array $data, $id)
    {
        $result = $this->retrieveRawStripeSubscription($id);

        if (count($data)) {
            foreach ($data as $key => $value) {
                $result->$key = $value;
            }
            $result->save();
        }
        dd($result);

        $subscription = $this->mapResultToSubscription($result);

        return $subscription;
    }

    /**
     * Cancel Subscription
     *
     * @param $id
     * @return mixed
     */
    public function cancelSubscription($id)
    {
        $result       = $this->retrieveRawStripeSubscription($id);
        $result       = $result->cancel();
        $subscription = $this->mapResultToSubscription($result);

        return $subscription;
    }
}
