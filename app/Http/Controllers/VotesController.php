<?php

namespace App\Http\Controllers;

use App\Repositories\AnswerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VotesController extends Controller
{
    protected $answerRepository;

    public function __construct(AnswerRepository $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }

    public function users($id)
    {
        if (Auth::guard('api')->user()->hasVotedFor($id)){
            return response()->json(['voted'=>true]);
        }
        return response()->json(['voted'=>false]);
    }

    public function vote()
    {
        $answer = $this->answerRepository->byId(request('answer'));
        $voted = Auth::guard('api')->user()->voteFor(request('answer'));

        if (count($voted['attached']) > 0) {
            $answer->increment('votes_count');

            return response()->json(['voted' => true]);
        }

        $answer->decrement('votes_count');

        return response()->json(['voted' => false]);
    }

}
