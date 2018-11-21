<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/21
 * Time: 15:10
 */

namespace App\Repositories;


use App\Model\Message;

class MessageRepository
{
    public function create(array $attributes)
    {
        return Message::create($attributes);
    }
}