<?php

namespace App\Http\Controllers\Auth;
use lluminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Task;
use App\Reviews;

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

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $per_count = User::where('isPerformer', true)->get()->count();
        $tasks_count = Task::all()->count();
        $reviews_count = Reviews::all()->count();
        return view('auth.login', compact('per_count', 'tasks_count', 'reviews_count'));
    }

    protected function credentials(Request $request)
    {   
        if(is_numeric($request->get('email'))) {
            return ['phone'=>$request->get('email'),'password'=>$request->get('password')];
        }
        return $request->only($this->username(), 'password');
    }
}

