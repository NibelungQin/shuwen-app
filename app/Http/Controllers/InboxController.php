<?php

namespace App\Http\Controllers;

use App\Notifications\NewMessageNotification;
use App\Repositories\MessageRepository;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    protected $messageRepository;
    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //将两个用户的消息都提取出来
        $messages = $this->messageRepository->getAllMessages();
        //根据接收消息的用户分组消息
        return view('inboxs.index',['messages'=>$messages->groupBy('dialog_id')]);
    }

    /**
     * @param $dialogId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($dialogId)
    {
        $messages = $this->messageRepository->getDialogMessage($dialogId);
        $messages->markAsRead();
        return view('inboxs.show',compact('messages','dialogId'));
    }

    /**
     * @param $dialogId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($dialogId)
    {
        $message = $this->messageRepository->getSingleMessage($dialogId);
        $toUserId = $message->from_user_id === user()->id ? $message->to_user_id : $message->from_user_id;
        $data = [
            'from_user_id' => user()->id,
            'to_user_id'   => $toUserId,
            'body'         => \request('body'),
            'dialog_id'    => $dialogId
        ];
        $newMessage = $this->messageRepository->create($data);
        $newMessage->toUser->notify(new NewMessageNotification($newMessage));
        return back();
    }
}
