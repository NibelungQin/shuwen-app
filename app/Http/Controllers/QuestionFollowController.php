<?php

namespace App\Http\Controllers;

use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionFollowController extends Controller
{
    protected $questionRepository;

    /**
     * QuestionFollowController constructor.
     * @param QuestionRepository $questionRepository
     */
    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    /**
     * @param $question
     * @return \Illuminate\Http\RedirectResponse
     */
    public function follow($question)
    {
        Auth::user()->followThis($question);
        return back();
    }

    /**
     * 显示页面用户关注问题的初始状态
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function follower(Request $request)
    {
        if (user('api')->followed($request->get('question'))){
            return response()->json(['followed'=>true]);
        }
        return response()->json(['followed'=>false]);
    }

    /**
     * 用户点击关注问题的按钮
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function followThisQuestion(Request $request)
    {
        $question = $this->questionRepository->byId($request->get('question'));
        $followed = user('api')->followThis($question->id);
        //用户已关注该问题
        if (count($followed['detached'])>0){
            $question->decrement('followers_count');
            return response()->json(['followed'=>false]);
        }
        $question->increment('followers_count');
        return response()->json(['followed'=>true]);
    }
}
