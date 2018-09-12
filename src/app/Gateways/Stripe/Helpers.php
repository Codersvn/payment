<?php

namespace VCComponent\Laravel\Payment\Gateways\Stripe;

use Stripe\Customer as StripeCustomer;
use Stripe\Stripe;
use VCComponent\Laravel\Payment\Models\BankAccount;
use VCComponent\Laravel\Payment\Models\Card;
use VCComponent\Laravel\Payment\Models\Charge;
use VCComponent\Laravel\Payment\Models\Customer;
use VCComponent\Laravel\Payment\Models\Subscription;

trait Helpers
{
    /**
     * Set gateway Api key
     */
    public function setApiKey()
    {
        Stripe::setApiKey(config('payment.stripe.keys.secret_key'));
    }

    /**
     * Map Stripe customer result to Package Customer object
     *
     * @param Stripe\Customer $result
     * @return VCComponent\Laravel\Payment\Models\Customer
     */
    private function mapResultToCustomer($result)
    {
        $customer = new Customer;
        $customer->setId($result->id)
            ->setEmail($result->email);

        if (count($result->sources->data)) {
            foreach ($result->sources->data as $source) {
                switch ($source->object) {
                    case 'card':
                        $card = $this->mapResultToCard($source);
                        $customer->setSources($card);
                        break;

                    case 'bank_account':
                        $account = $this->mapResultToBankAccount($source);
                        $customer->setSources($account);
                        break;
                }
            }
        }

        return $customer;
    }

    /**
     * Map result to Card object
     *
     * @param $result
     * @return mixed
     */
    private function mapResultToCard($result)
    {
        $card = new Card;
        $card->setId($result->id)
            ->setType($result->object)
            ->setBrand($result->brand)
            ->setLast4($result->last4)
            ->setCountry($result->country)
            ->setExpMonth($result->exp_month)
            ->setExpYear($result->exp_year);

        return $card;
    }

    /**
     * Map result to BankAccount object
     *
     * @param $result
     * @return mixed
     */
    private function mapResultToBankAccount($result)
    {
        $account = new BankAccount;
        $account->setId($result->id)
            ->setType($result->object)
            ->setAccountHolderName($result->account_holder_name)
            ->setAccountHolderType($result->account_holder_type)
            ->setLast4($result->last4)
            ->setCountry($result->country)
            ->setCurrency($result->currency);

        return $account;
    }

    /**
     * Map result to Charge object
     *
     * @param $charge
     * @return mixed
     */
    private function mapResultToCharge($result)
    {
        $charge = new Charge;
        $charge->setId($result->id)
            ->setAmount($result->amount, $result->currency)
            ->setCurrency($result->currency)
            ->setDescription($result->description)
            ->setDestination($result->destination)
            ->setCustomer($result->customer);

        switch ($result->source->object) {
            case 'card':
                $card = $this->mapResultToCard($result->source);
                $charge->setSource($card);
                break;

            case 'bank_account':
                $account = $this->mapResultToBankAccount($result->source);
                $charge->setSource($account);
                break;
        }

        return $charge;
    }

    /**
     * Map result to Subscription object
     * 
     * @param $result
     * @return mixed
     */
    private function mapResultToSubscription($result)
    {
        $subscription = new Subscription;
        $subscription->setId($result->id)
            ->setPlanId($result->plan->id)
            ->setCustomer($result->customer)
            ->setQuantity($result->quantity)
            ->setStatus($result->status)
            ->setTrialEnd($result->trial_end);

        return $subscription;
    }
}
