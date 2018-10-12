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
    public function welcome(User $user)
    {
        $template = 'emails.welcome';
        $title = '欢迎注册书问，您值得拥有';
        $data = [
            'url' => 'www.baidu.com',
            'name' => $user->name,
        ];
        $this->sendTo($template,$user->email,$title,$data);
    }
}