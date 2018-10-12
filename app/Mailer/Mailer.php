<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/12
 * Time: 15:07
 */

namespace App\Mailer;


use Illuminate\Support\Facades\Mail;

/**
 * Class Mailer
 * @package App\Mailer
 * 邮件发送基础模板
 */
class Mailer
{
    /**
     * @param string $template 邮件模板
     * @param string $email    接收邮件用户邮箱
     * @param array  $data     发送的数据
     *
     */
    protected function sendTo($template,$email,$title,array $data)
    {
        Mail::send($template,$data,function ($message) use ($email,$title){
            $message->to($email)->subject($title);
        });
    }
}