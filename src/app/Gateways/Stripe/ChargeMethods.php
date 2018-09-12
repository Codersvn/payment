<?php

namespace VCComponent\Laravel\Payment\Gateways\Stripe;

use Stripe\Charge as StripeCharge;

trait ChargeMethods
{
    /**
     * Retrieve raw Stripe Charge
     *
     * @param $id
     * @return mixed
     */
    private function retrieveRawStripeCharge($id)
    {
        $charge = StripeCharge::retrieve($id);
        return $charge;
    }

    /**
     * Create Charge
     *
     * @param array $data
     * @return mixed
     */
    public function createCharge(array $data)
    {
        $data['amount'] = $data['amount'] * 100;
        $result         = StripeCharge::create($data);
        $charge         = $this->mapResultToCharge($result);

        return $charge;
    }

    /**
     * Retrieve Charge
     *
     * @param $id
     * @return mixed
     */
    public function retrieveCharge($id)
    {
        $result = $this->retrieveRawStripeCharge($id);
        $charge = $this->mapResultToCharge($result);

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
        $result = StripeCharge::all($data);
        $arr    = [];

        if (count($result->data)) {
            foreach ($result->data as $item) {
                $arr[] = $this->mapResultToCharge($item);
            }
        }

        $charges = collect($arr);

        return $charges;
    }

    /**
     * Update Charge
     *
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function updateCharge(array $data, $id)
    {
        $result = $this->retrieveRawStripeCharge($id);

        if (count($data)) {
            foreach ($data as $key => $value) {
                $result->$key = $value;
            }
            $result->save();
        }

        $charge = $this->retrieveCharge($id);

        return $charge;
    }
}
