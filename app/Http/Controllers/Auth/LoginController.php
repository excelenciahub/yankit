<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Socialite;
use App\User;
use Carbon\Carbon;
use Validator;
use Session;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest')->except('logout');
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
        if($user->status!='Active'){
            Auth::logout();
            $this->guard()->logout();
            $request->session()->flush();
            $request->session()->regenerate();
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'email' => ['Your account is disabled by admin.'],
            ]);
            throw $error;
        }
        else{
            return ['status'=>true, 'message'=>'Login successfull'];
        }
    }

    /**
     * Handle Social login request
     *
     * @return response
     */
    public function socialLogin(Request $request, $social)
	{
        Session::put('user_type', $request->user_type?$request->user_type:'Sender');
        return Socialite::driver($social)->redirect();
	}

    /**
     * Obtain the user information from Social Logged in.
     * @param $social
     * @return Response
     */
    public function handleProviderCallback($social)
	{
        $data = [];
        try{
            $uer_type = Session::get('user_type');
            $userSocial = Socialite::driver($social)->user();
            if($social=='facebook'){
                $data = [
                    'social_id' => $userSocial->id,
                    'name' => $userSocial->user['name'],
                    'username' => $userSocial->nickname,
                    'avatar' => $userSocial->avatar_original,
                    'email' => isset($userSocial->email)?$userSocial->email:'',
                    'phone' => isset($userSocial->mobile)?$userSocial->mobile:'',
                    'social_provider' => $social,
                    'social_data' => json_encode($userSocial),
                    'email_verified_at' => Carbon::now(),
                ];
            }
            else if($social=='google'){
                $data = [
                    'social_id' => $userSocial->id,
                    'name' => $userSocial->user['name'],
                    'avatar' => $userSocial->avatar_original,
                    'email' => $userSocial->email,
                    'social_provider' => $social,
                    'social_data' => json_encode($userSocial),
                    'email_verified_at' => Carbon::now(),
                ];
            }
            else{
                return redirect()->to('/');
            }
            
            $user = User::where(['email' => $userSocial->getEmail(), 'social_provider'=>$social, 'user_type'=>$uer_type])->first();
            if ($user)
            {
                if($user->status=='0'){
                    $validator = Validator::make($data, []);
                    $errors = $validator->messages();
                    $errors->add('Error', 'Your account is disabled by admin');
                    return redirect()->to(route('dashboard'))->withErrors($errors);
                }
                $dirty = json_decode($user->dirty, true);
                if(is_array($dirty)){
                    foreach($dirty as $key=>$val){
                        if(isset($data[$val])){
                            unset($data[$val]);
                        }
                    }
                }
                User::where(['email' => $userSocial->getEmail(), 'social_provider'=>$social, 'user_type'=>$uer_type])->update($data);
            }
            else
            {
                $data['user_type'] = $uer_type;
                $user = User::create($data);
            }
            Auth::login($user);
        }
        catch(\Exception $e){}
        return redirect()->to(route('dashboard'));
	}
}
