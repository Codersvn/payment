<?php

namespace VCComponent\Laravel\Payment\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Customer.
 *
 * @package namespace VCComponent\Laravel\Customer\Entities;
 */
class Customer extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'user_id',
    ];

    /**
     * Get the user for the customer
     *
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

    /**
     * Get the payments for the customer
     *
     * @return mixed
     */
    public function payments()
    {
        return $this->hasMany(config('payment.models.payment'));
    }

    /**
     * Get the subscriptions for the customer
     * 
     * @return mixed
     */
    public function subscriptions()
    {
        return $this->hasMany(config('payment.models.subscription'));
    }

}
