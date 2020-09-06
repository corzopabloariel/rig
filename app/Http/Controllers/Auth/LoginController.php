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
        unset($requestData["email"]);
        $email = \App\Email::where("email", $request->email)->first();
        if ($email) {// $this->guard()->validate($this->credentials($request))
            $users = $email->users;
            if ($users->isEmpty())
                return back()->withErrors(['mssg' => "Datos incorrectos o no encontrados"])->withInput();
            foreach($users AS $user) {
                if(\Hash::check($request->password, $user->password))
                    break;
            }
            $requestData["id"] = $user->id;
            $requestData["remember_token"] = null;
            if (Auth::attempt($requestData)) {
                (new \App\Log)->create("users", Auth::user()->id, "LOGIN OK", Auth::user()->id, "L");
                return redirect(Auth::user()->redirect());
            } else {
                (new \App\Log)->create("users", $email->user_id, "LOGIN ERR", $email->user_id, "L");
                return back()->withErrors(['mssg' => "Datos incorrectos o no encontrados"])->withInput();
            }
        } else {
            $this->incrementLoginAttempts($request);
            return back()->withErrors(['mssg' => "Datos incorrectos o no encontrados"])->withInput();
        }
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
