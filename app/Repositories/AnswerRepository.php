<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/2
 * Time: 13:52
 */

namespace App\Repositories;


use App\Model\Answer;

class AnswerRepository
{
    /**
     * 创建问题的答案
     * @param array $attribute
     * @return mixed
     */
    public function create(array $attribute)
    {
        return Answer::create($attribute);
    }

    public function byId($id)
    {
        return Answer::find($id);
    }

    public function getAnswerCommentsById($id)
    {
        $answer = Answer::with('comments','comments.user')->where('id',$id)->first();
        return $answer->comments;
    }
}