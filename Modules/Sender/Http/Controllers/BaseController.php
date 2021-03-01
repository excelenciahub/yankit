<?php

namespace Modules\Sender\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Cart;
use View;

class BaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function($request, $next){
            $user = auth()->user();
            if($user->user_type!=='Sender'){
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'user' => ['Please login with sender account.'],
                ]);
                throw $error;
                return front_force_logout();
            }
            front_cart_data();
            return $next($request);
        });
    }
}
