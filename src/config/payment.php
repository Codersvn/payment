<?php

return [

		/**
		 * 
		 * Payment models
		 * 
		 */
		'models' => [
				'payment' => VCComponent\Laravel\Payment\Entities\Payment::class,
				'customer' => VCComponent\Laravel\Payment\Entities\Customer::class,
				'subscription' => VCComponent\Laravel\Payment\Entities\Subscription::class
		],

		/**
		 * 
		 * Stripe configuration
		 * 
		 */
    'stripe' => [
        'keys' => [
            'publish_key' => env('STRIPE_PUBLISH_KEY', ''),
            'secret_key'  => env('STRIPE_SECRET_KEY', ''),
        ],
    ],

];
