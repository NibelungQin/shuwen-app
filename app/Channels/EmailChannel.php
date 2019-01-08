<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/4
 * Time: 15:29
 */

namespace App\Channels;


use Illuminate\Notifications\Notification;

class EmailChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSend($notifiable);
    }
}
