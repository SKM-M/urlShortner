<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\LoginService;
use Illuminate\Http\Request;
use Auth;
use Socialite;
use Carbon\Carbon;

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
     * Create a new controller instance.
     *
     * @return void
     */
    private $loginService;

    public $successStatus = 200;

    public function __construct(LoginService $loginService)
    {
        //$this->middleware('guest')->except('logout');
        $this->loginService = $loginService;
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        if (Auth::check()) {
            $user = Auth::user();
            return $user;
        }
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Check User Login Attempt 
     *
     * @return Response
     */
    public function login(Request $request)
    {
        
         // Validate form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        // Attempt to authenticate user
        // If successful, redirect to their intended location
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->intended('home');
        }
        // Authentication failed, redirect back to the login form
        return redirect()->back()->withInput($request->only('email', 'remember'));

    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $userExists = $this->loginService->findOrCreateUser($user, $provider);
        
    
        // Login and "remember" the given user...
        if (Auth::attempt(['email' => $userExists->email, 'password' => '555555'], 'on')) {
            return redirect()->intended('home');
        }
        //return Redirect::to($url);   
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->intended('login');
    }
}
