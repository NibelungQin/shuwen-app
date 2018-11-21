<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';

    protected $fillable = ['user_id','question_id','body'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questions()
    {
        return $this->belongsTo(Question::class);
    }

    public function comments()
    {
        return $this->morphMany('App\Model\Comment','commentable');
    }
}
