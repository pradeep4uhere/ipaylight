<?php 
namespace App\Services;

class PayoutServiceFactory
{
    protected $services;

    public function __construct(PaygeniusService $paygeniusService, CashfreeService $cashfreeService, RazorpayService $razorpayService)
    {
        $this->services = [
            'PG' => $paygeniusService,
            'CF' => $cashfreeService,
            'RZ' => $razorpayService,
        ];
    }

    public function getService($serviceName)
    {
        if (!isset($this->services[$serviceName])) {
            throw new \InvalidArgumentException("Invalid service name: $serviceName");
        }

        return $this->services[$serviceName];
    }
}
