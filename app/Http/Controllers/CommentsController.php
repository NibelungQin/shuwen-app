<?php

namespace App\Http\Controllers;

use App\Repositories\AnswerRepository;
use App\Repositories\CommentRepository;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    protected $questionRepository;
    protected $answerRepository;
    protected $commentRepository;

    public function __construct(QuestionRepository $questionRepository,AnswerRepository $answerRepository,CommentRepository $commentRepository)
    {
        $this->questionRepository = $questionRepository;
        $this->answerRepository = $answerRepository;
        $this->commentRepository = $commentRepository;
    }

    public function question($id)
    {
        $test =  $this->questionRepository->getQuestionCommentsById($id);
        dd($test);
    }

    public function store()
    {

    }

    public function getModelNameFormType($type)
    {
        return $type === 'question' ? 'App\Model\Question' : 'App\Model\Answer';
    }

}
