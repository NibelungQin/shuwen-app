<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/12
 * Time: 15:16
 */

namespace App\Mailer;



use App\User;

class UserMailer extends Mailer
{
    /**
     * @param User $user
     */
    public function welcome(User $user)
    {
        $template = 'emails.welcome';
        $title = '欢迎注册书问，您值得拥有';
        $data = [
            'url' => route('email.verify',['token'=>$user->confirmation_token]),
            'name' => $user->name,
        ];
        $this->sendTo($template,$user->email,$title,$data);
    }

    public function passwordReset($email,$token)
    {
        $template = 'emails.passwordReset';
        $title = '重置密码';
        $data =  [
            'url' => route('password/reset',$token),
        ];
        $this->sendTo($template,$email,$title,$data);
    }
}