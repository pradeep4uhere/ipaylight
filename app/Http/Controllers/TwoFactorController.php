<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FALaravel\Support\Authenticator;

class TwoFactorController extends Controller
{
    public function show2faForm()
    {
        return view('auth.2fa');
    }

    public function verify2fa(Request $request, Authenticator $authenticator)
    {
        if ($authenticator->check($request->input('2fa_code'))) {
            $request->session()->put('2fa_authenticated', true);
            return redirect()->intended();
        }

        return redirect()->route('2fa.verify')->withErrors(['2fa_code' => 'Invalid 2FA code']);
    }
}
