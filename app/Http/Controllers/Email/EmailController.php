<?php

namespace App\Http\Controllers\Email;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EmailController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }


    /**
     * 验证邮箱
     * @param $token
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function verify($token)
    {
        $user = $this->user->byToken($token);
        if (is_null($user)){
            return redirect('/');
        }
        $user->is_active = 1;
        $user->confirmation_token = str_random(40);
        $user->save();
        Auth::login($user);
        return redirect('/home');
    }
}
