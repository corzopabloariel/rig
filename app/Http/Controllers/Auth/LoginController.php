<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $requestData = $request->all();
        unset($requestData["_token"]);
        $this->validateLogin($request);
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        if ($this->guard()->validate($this->credentials($request))) {
            if (Auth::attempt($requestData))
                return redirect(Auth::user()->redirect());
            else
                return back()->withErrors(['mssg' => "Datos de {$request->email} incorrectos"]);
        } else {
            $this->incrementLoginAttempts($request);
            return back()->withErrors(['mssg' => "Datos de {$request->email} no encontrados"])->withInput();
        }
            /*    Auth::user()->fill(["login" => date("c")]);
                Auth::user()->save();
                return redirect( $this->redirectTo );
            } else {
                $this->incrementLoginAttempts($request);
                return back()->withErrors(['mssg' => "Datos de {$request->username} no encontrados"]);
            }
        }*/
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect($user->redirect());
    }

    public function logout(Request $request)
    {
        //dd(Auth::guard('web')->logout());
        Auth::logout();
        return redirect('login');
    }
}
