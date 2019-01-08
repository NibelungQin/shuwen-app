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

    public function getAllMessages()
    {
        return Message::where('from_user_id',user()->id)
            ->orWhere('to_user_id',user()->id)
            ->with(['fromUser'=>function($query){
                return $query->select(['id','name','avatar']);
            },'toUser'=>function($query){
                return $query->select(['id','name','avatar']);
            }])->latest()->get();
    }

    public function getDialogMessage($dialogId)
    {
        return Message::where('dialog_id',$dialogId)
            ->with(['fromUser'=>function($query){
                return $query->select(['id','name','avatar']);
            },'toUser'=>function($query){
                return $query->select(['id','name','avatar']);
            }])->latest()->paginate(20);
    }

    public function getSingleMessage($dialogId)
    {
        return Message::where('dialog_id',$dialogId)->first();
    }
}
