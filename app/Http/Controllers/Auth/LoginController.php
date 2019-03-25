<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login'  , ['url' => '']);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLandlordLoginForm()
    {
        return view('auth.login', ['url' => 'landlord']);
    }

    public function landlordLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard()->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember')) ) {
            if(Auth::user()->landlord()->exists())
                return $this->sendLoginResponse($request , LANDLORD_USER);
            else
                return redirect('/tenant')->with([
                    'message_danger' => 'You are not registered as a Landlord'
                ]);
        }



        return back()->withInput($request->only('email', 'remember'));
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer  $login_type
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request , $login_type = TENANT_USER)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        switch ($login_type){
            case LANDLORD_USER:
                $this->redirectTo = '/landlord/ticket';
                break;
            default:
                $this->redirectTo = '/tenant/ticket';
                break;
        }

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect($this->redirectPath());
    }
}
