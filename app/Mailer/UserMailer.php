<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/12
 * Time: 15:16
 */

namespace App\Mailer;



use App\User;
use Illuminate\Support\Facades\Auth;

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

    /**
     * 用户关注另一个用户发送邮件通知
     * @param $email
     */
    public function followUser($email)
    {
        $template = 'emails.followUser';
        $title = '有人关注了你';
        $data = [
            'name' => \user('api')->name,
        ];
        $this->sendTo($template,$email,$title,$data);
    }
}
