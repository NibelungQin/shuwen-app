<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/15
 * Time: 12:21
 */

namespace App\Repositories;


use App\Model\Question;
use App\Model\Topic;

class QuestionRepository
{
    /**
     * 创建问题
     * @param array $data
     * @return Question
     */
    public function create(array $data)
    {
        return Question::create($data);
    }

    /**
     * 若关键词数据库中没有，则加入数据库，并获得其id
     * @param array $topics
     * @return array
     */
    public function normalizeTopic(array $topics)
    {
        return collect($topics)->map(function ($topic){
           if (is_numeric($topic)){
               Topic::find($topic)->increment('questions_count');
               return (int)$topic;
           }
           $newTopic = Topic::create(['name'=>$topic,'questions_count'=>1]);
           return $newTopic->id;
        })->toArray();
    }

    /**
     * 根据id返回问题及其关联的话题与回答
     * @param integer $id
     * @return mixed
     */
    public function byIdWithTopicsAndAnswers($id)
    {
        return Question::where('id',$id)->with(['topics'])->first();
    }

    public function byId($id)
    {
        return Question::find($id);
    }

    public function getQuestionCommentsById($id)
    {
        $question = Question::with('comments','comments.user')->where(['id'=>$id])->first();
        return $question->comments;
    }
}