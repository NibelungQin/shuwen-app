<?php

namespace App\Http\Controllers;

use App\Notifications\NewMessageNotification;
use App\Notifications\NewUserFollowNotification;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowersController extends Controller
{
    protected $userRepository;

    /**
     * FollowersController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id)
    {
        $user = $this->userRepository->byId($id);
        //pluck() 从数据表中取得单一数据列的单一字段
        $followers = $user->followersUser()->pluck('follower_id')->toArray();

        if (in_array(user('api')->id,$followers)){
            return response()->json(['followed'=>true]);
        }
        return response()->json(['followed'=>false]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function follow()
    {
        $userToFollow = $this->userRepository->byId(\request('user'));
        $followed = user('api')->followThisUser($userToFollow);
        //判断用户是否已关注该用户
        if (count($followed['attached'])>0){
            $userToFollow->notify(new NewUserFollowNotification());
            $userToFollow->increment('followers_count');
            return response()->json(['followed'=>true]);
        }
        $userToFollow->decrement('followers_count');
        return response()->json(['followed'=>false]);
    }

}
