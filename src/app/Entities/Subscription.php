<?php

namespace VCComponent\Laravel\Payment\Entities;

use Illuminate\Database\Eloquent\Model;
use VCComponent\Laravel\Payment\Entities\Customer;

class Subscription extends Model
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
     * Get the customer for the subscripiton
     * 
     * @return mixed
     */
    public function customer()
    {
        return $this->belongsTo(config('payment.models.customer'));
    }
}
