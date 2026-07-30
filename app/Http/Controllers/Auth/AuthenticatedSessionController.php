<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use PragmaRX\Google2FA\Google2FA;

class AuthenticatedSessionController extends Controller
{

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }


    /**
     * Display the login view.
     */
    public function showTwoAuthView(): View
    {
        return view('auth.two-auth-login');
    }    

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        $url = '';
        if($request->user()->role === 'admin'){
            $url = '/admin/dashboard';
        }else if($request->user()->role === 'distributor'){
            $url = '/ds/dashboard';
        }else if($request->user()->role === 'retailer'){
            $url = '/ro/dashboard';
        }else{
            $url = 'dashboard';
        }
        if ($this->istwoStepVerificationEnabled($request)) {
            return redirect()->route('2fa.show');
        }else{
            return redirect()->intended($url);
        }
    }




    public function istwoStepVerificationEnabled(Request $request)
    {
        //dd($request->user()->uses_two_factor_auth);
        if ($request->user()->uses_two_factor_auth) {
            $google2fa = new Google2FA();
    
            if ($request->session()->has('2fa_passed')) {
                $request->session()->forget('2fa_passed');
            }
    
            $request->session()->put('2fa:user:id', $request->user()->id);
            $request->session()->put('2fa:auth:attempt', true);
            $request->session()->put('2fa:auth:remember', $request->has('remember'));
    
            $otp_secret = 'NFUWSN3XKZWFCVZTNAYTC4DHJFQVGRLUM2X6SHKTROIZPC7BDCUBE7HS7CWUDQCL';
            $one_time_password = $google2fa->getCurrentOtp($otp_secret);
            return redirect()->route('2fa.show')->with('one_time_password', $one_time_password);
        }else{
            return false;
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }


   

    /**
     * Verify the 2FA code.
     */
    public function verifyTwoFactorAuth(Request $request): RedirectResponse
    {
        $request->validate([
            '2fa_code_1' => 'required|digits:1',
            '2fa_code_2' => 'required|digits:1',
            '2fa_code_3' => 'required|digits:1',
            '2fa_code_4' => 'required|digits:1',
            '2fa_code_5' => 'required|digits:1',
            '2fa_code_6' => 'required|digits:1',
        ]);
        $user = Auth::user();
        $google2fa = new Google2FA();
        $code_2fa = $request->input('2fa_code_1').$request->input('2fa_code_2').$request->input('2fa_code_3').$request->input('2fa_code_4').$request->input('2fa_code_5').$request->input('2fa_code_6');
        $otp_secret = $user->google2fa_secret; // Assuming the secret is stored in the user model
        $valid = $google2fa->verifyKey($otp_secret, $code_2fa);
        if ($valid) {
            $request->session()->put('2fa_passed', true);
            return redirect()->intended($this->redirectPath($user));
        }
        return redirect()->route('2fa.show')->withErrors(['error' => 'Invalid 2FA code']);
    }


    protected function redirectPath($user)
    {
        if ($user->role === 'admin') {
            return '/admin/dashboard';
        } elseif ($user->role === 'superdistributor') {
            return '/sds/dashboard';
        } elseif ($user->role === 'distributor') {
            return '/ds/dashboard';
        } elseif ($user->role === 'retailer') {
            return '/ro/dashboard';
        } else {
            return '/dashboard';
        }
    }


}
