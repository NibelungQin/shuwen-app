<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Repositories\AnswerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswersController extends Controller
{
    protected $answerRepository;

    /**
     * AnswersController constructor.
     * @param AnswerRepository $answerRepository
     */
    public function __construct(AnswerRepository $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }

    /**
     * @param StoreAnswerRequest $request
     * @param $question int 问题id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreAnswerRequest $request,$question)
    {
        $data = [
            'user_id'     => Auth::id(),
            'question_id' => $question,
            'body'        => $request->get('body'),
        ];
        $answer = $this->answerRepository->create($data);
//        $answer->questions()->increment('answers_count');
        dd($answer);
//        return back();
    }

}
