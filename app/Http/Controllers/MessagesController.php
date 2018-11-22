<?php

namespace App\Http\Controllers;

use App\Repositories\MessageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    protected $messageRepository;

    /**
     * MessagesController constructor.
     * @param MessageRepository $messageRepository
     */
    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $data = [
            'from_user_id' => Auth::guard('api')->user()->id,
            'to_user_id'   => request('user'),
            'body'         => request('body'),
            'dialog_id'    => time().Auth::id(),
        ];
        $message = $this->messageRepository->create($data);
        if ($message){
            return response()->json(['status'=>true]);
        }
        return response()->json(['status'=>false]);
    }

}
