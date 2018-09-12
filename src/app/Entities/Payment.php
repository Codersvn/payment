<?php

namespace VCComponent\Laravel\Payment\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment.
 *
 * @package namespace VCComponent\Laravel\Payment\Entities;
 */
class Payment extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'customer_id',
    ];

    /**
     * Get the customer for the payment
     * 
     * @return mixed
     */
    public function customer()
    {
        return $this->belongsTo(config('payment.models.customer'));
    }

    /**
     * Get the user for the payment
     * 
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

}
