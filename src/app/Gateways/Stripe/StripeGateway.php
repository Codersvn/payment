<?php

namespace VCComponent\Laravel\Payment\Gateways\Stripe;

use VCComponent\Laravel\Payment\Gateways\GatewayInterface;
use VCComponent\Laravel\Payment\Gateways\Stripe\ChargeMethods;
use VCComponent\Laravel\Payment\Gateways\Stripe\CustomerMethods;
use VCComponent\Laravel\Payment\Gateways\Stripe\Helpers;
use VCComponent\Laravel\Payment\Gateways\Stripe\SubscriptionMethods;

class StripeGateway implements GatewayInterface
{
    use Helpers,
        CustomerMethods,
        ChargeMethods,
        SubscriptionMethods;

    public function __construct()
    {
        $this->setApiKey();
    }
}
