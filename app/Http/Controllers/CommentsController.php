<?php

namespace App\Http\Controllers;

use App\Repositories\AnswerRepository;
use App\Repositories\CommentRepository;
use App\Repositories\QuestionRepository;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    protected $questionRepository;
    protected $answerRepository;
    protected $commentRepository;

    public function __construct(QuestionRepository $questionRepository,
                                AnswerRepository $answerRepository,
                                CommentRepository $commentRepository)
    {
        $this->questionRepository = $questionRepository;
        $this->answerRepository = $answerRepository;
        $this->commentRepository = $commentRepository;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function question($id)
    {
        return  $this->questionRepository->getQuestionCommentsById($id);;
    }

    /**
     * @param $id
     * @return AnswerRepository|\Illuminate\Database\Eloquent\Model|null|object
     */
    public function answer($id)
    {
        return $this->answerRepository->getAnswerCommentsById($id);
    }

    /**
     * @return mixed
     */
    public function store()
    {
        $model = $this->getModelNameFormType(request('type'));

        return $this->commentRepository->create([
            'commentable_id' => request('model'),
            'commentable_type' => $model,
            'user_id' => user('api')->id,
            'body' => request('body'),
        ]);
    }

    /**
     * @param $type
     * @return string
     */
    public function getModelNameFormType($type)
    {
        return $type === 'question' ? 'App\Model\Question' : 'App\Model\Answer';
    }

}
