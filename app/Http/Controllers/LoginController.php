<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Check authentication
     */
    function checkAuth(Request $request): RedirectResponse
    {
        $request->validate([
            'mobile_number' => 'required',
            'pin' => 'required',
        ]);

        $auth = User::where('mobile_number', '=', $request->mobile_number)
            ->where('pin', '=', $request->pin)->first();

        if ($auth) {
            Auth::guard('web')->login($auth);
            return redirect('dashboard')->withSuccess('Signed in');
        }

        Session::flash('message_error', 'Invalid Credentials!');
        return redirect('/');
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        return redirect('/');
    }
}
