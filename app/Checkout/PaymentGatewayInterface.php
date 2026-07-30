<?php namespace App\Checkout;
use Illuminate\Http\Request;

interface PaymentGatewayInterface
{
    /**
     * PreProcess For Payment Gateway 
     */
    public function process(Request $request);

    /***
     * Final Checkout for Payment  Processing
     * @param Request $request
     * @return bool|PaymentResponse
     */
    public function checkout($res);



     /***
     * Get Payment Gateway Configuration
     * @return bool|PaymentResponse
     * @param GatewayId
     */
    public function getGatewayConfigurtion($gateway_id);


    /***
     * Get Payment Gateway Configuration
     * @return bool|PaymentResponse
     * @param GatewayId
     */
    public function paymentReturnStatus(Request $request);



    /**
     * Get Commission Rate for Current Payment Type
     * Get the Rate for Payment Type from UserCommission Table
     * based on paymenttype from payment gayeway
     */
    public function getCurrentPaymentType($result);
}