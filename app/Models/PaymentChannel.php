<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentChannel extends Model
{
    protected $table = 'payment_channels';

    protected $guarded = ['id'];

    public $timestamps = false;

    public static $classes = [
        'Alipay', 'Authorizenet', 'Bitpay', 'Braintree', 'Cashu', 'Flutterwave',
        'Instamojo', 'Iyzipay', 'Izipay', 'KlarnaCheckout', 'MercadoPago', 'Midtrans',
        'Mollie', 'Ngenius', 'Payfort', 'Payhere', 'Payku', 'Paylink', 'Paypal',
        'Paysera', 'Paystack', 'Paytm', 'Payu', 'Razorpay', 'Robokassa', 'Sslcommerz',
        'Stripe', 'Toyyibpay', 'Voguepay', 'YandexCheckout', 'Zarinpal', 'JazzCash',
        'Redsys',
    ];

    public static $gatewayIgnoreRedirect = [
        'Paytm', 'Payu', 'Zarinpal', 'Stripe', 'Paysera', 'Cashu',
        'MercadoPago', 'Payhere', 'Authorizenet', 'Voguepay', 'Payku', 'KlarnaCheckout', 'Izipay', 'Iyzipay',
        'JazzCash', 'Redsys',
    ];

    public static $paypal = 'Paypal';

    public static $paystack = 'Paystack';

    public static $paytm = 'Paytm';

    public static $payu = 'Payu';

    public static $razorpay = 'Razorpay';

    public static $zarinpal = 'Zarinpal';

    public static $stripe = 'Stripe';

    public static $paysera = 'Paysera';

    public static $fastpay = 'Fastpay';

    public static $yandexcheckout = 'YandexCheckout';

    public static $twoCheckout = '2checkout';

    public static $bitpay = 'Bitpay';

    public static $midtrans = 'Midtrans';

    public static $adyen = 'Adyen';

    public static $flutterwave = 'Flutterwave';

    public static $payfort = 'Payfort';

    public static $sslcommerz = 'Sslcommerz';

    public static $instamojo = 'Instamojo';

    public static $payhere = 'Payhere';

    public static $ngenius = 'Ngenius';

    public static $authorizenet = 'Authorizenet';

    public static $voguepay = 'Voguepay';

    public static $payku = 'Payku';

    public static $toyyibpay = 'Toyyibpay';

    public static $robokassa = 'Robokassa';

    public static $klarnaCheckout = 'KlarnaCheckout';

    public static $mollie = 'Mollie';

    public static $alipay = 'Alipay';

    public static $braintree = 'Braintree';

    public static $izipay = 'Izipay';

    public static $paylink = 'Paylink';

    public static $jazzCash = 'JazzCash';

    public static $redsys = 'Redsys';

    public function getCurrenciesAttribute()
    {
        if (! empty($this->attributes['currencies'])) {
            return json_decode($this->attributes['currencies'], true);
        }

        return [];
    }
}
