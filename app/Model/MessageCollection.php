<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/7
 * Time: 12:47
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Collection;

class MessageCollection extends Collection
{
    public function markAsRead()
    {
        $this->each(function ($message){
            if ($message->to_user_id === user()->id ){
                $message->markAsRead();
            }
        });
    }
}
