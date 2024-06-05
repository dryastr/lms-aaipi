<?php

namespace App\PaymentChannels;

use App\Models\Order;
use App\Models\PaymentChannel;
use Illuminate\Http\Request;

interface IChannel
{
    /**
     * IChannel constructor.
     */
    public function __construct(PaymentChannel $paymentChannel);

    /**
     * @return Order
     */
    public function paymentRequest(Order $order);

    /**
     * @return mixed
     */
    public function verify(Request $request);
}
