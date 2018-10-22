<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/15
 * Time: 10:24
 */

namespace App\Repositories;


use App\User;

class UserRepository
{
    /**
     * 用户注册邮箱确认时通过token获得该用户
     */
    public function byToken($token)
    {
        $user = User::where('confirmation_token',$token)->first();
        return $user;
    }
}