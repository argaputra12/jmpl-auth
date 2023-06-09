<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Termwind\Components\Dd;

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
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $vars = array(
            'secret' => "6LcNs3MlAAAAAF_JtHmcxIYfXP2bQDcafoo8_kaU",
            "response" => $request->input('recaptcha_v3')
        );
        $url = "https://www.google.com/recaptcha/api/siteverify";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
        $encoded_response = curl_exec($ch);
        $response = json_decode($encoded_response, true);
        curl_close($ch);

        // dd($response);
        if ($response['success'] && $response['action'] == 'homepage' && $response['score'] > 0.5) {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email|min:3|max:255',
                'password' => 'required|min:3|max:255|alpha_num',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Please fill in the form according to the regulations.');
            }

            $request->authenticate();

            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::HOME);

        } else {

            return redirect()->back()->withErrors(['recaptcha_v3' => 'Please verify that you are not a robot.']);
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
}