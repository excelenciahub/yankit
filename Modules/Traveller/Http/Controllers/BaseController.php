<?php

namespace Modules\Traveller\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

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
            if(auth()->user()->user_type!=='Traveller'){
                $error = \Illuminate\Validation\ValidationException::withMessages([
                    'user' => ['Please login with traveller account.'],
                ]);
                throw $error;
                return front_force_logout();
            }
            return $next($request);
        });
    }
}
