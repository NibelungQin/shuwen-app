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


    public function normalizeTopic(array $topics)
    {
        return collect($topics)->map(function ($topic){
           if (is_numeric($topic)){
               Topic::find($topic)->increment('questions_count');
               return (int)$topic;
           }
           $newTopic = Topic::create(['name'=>$topic,'questions_count'=>1]);
           return $newTopic;
        })->toArray();
    }
}