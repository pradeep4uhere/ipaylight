<?php namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Helpers\CustomHelper;
use App\Checkout\PaymentGatewayInterface;
use App\Checkout\Gateways\RazorpayGateway;
use App\Checkout\Gateways\CashfreeGateway;
use App\Checkout\Gateways\EasebuzzGateway;
use App\Checkout\Gateways\PhonePeGateway;
use App\Checkout\Gateways\PaygeniusGateway;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Blade;
use App\Services\CashfreeService;
use App\Services\PaygeniusService;
use App\Services\RazorpayService;
use App\Services\PayoutServiceFactory;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->singleton(PaygeniusService::class, function ($app) {
            return new PaygeniusService();
        });
        
        $this->app->singleton(CashfreeService::class, function ($app) {
            return new CashfreeService();
        });

        $this->app->singleton(RazorpayService::class, function ($app) {
            return new RazorpayService();
        });

        $this->app->singleton(PayoutServiceFactory::class, function ($app) {
            return new PayoutServiceFactory(
                $app->make(PaygeniusService::class),
                $app->make(CashfreeService::class),
                $app->make(RazorpayService::class)
            );
        });

        $this->app->bind(PaymentGatewayInterface::class, function($app){
            $gateway = request()->gateway;
            //dd($gateway);
            if(Str::ucfirst(Str::lower($gateway)) == 'Razorpay'){
                return new RazorpayGateway();
            }else if(Str::ucfirst(Str::lower($gateway)) == 'Cashfree'){
                return new CashfreeGateway();
            }else if(Str::ucfirst(Str::lower($gateway)) == 'Easebuzz'){
                return new EasebuzzGateway();
            }else if(Str::ucfirst(Str::lower($gateway)) == 'Phonepe'){
                return new PhonePeGateway();
            }else if(Str::ucfirst(Str::lower($gateway)) == 'Paygenius'){
                return new PaygeniusGateway();
            }else{
                return new PaygeniusGateway();
                //$gateway = env('DEFAULT_GATEWAY');
                //return new $gateway();
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Config::set('app.timezone', 'Asia/Kolkata');
        View::composer('*', function ($view) {
            $currentRouteName = Route::currentRouteName();
            $view->with('actionName', $currentRouteName);
        });
    }
}
