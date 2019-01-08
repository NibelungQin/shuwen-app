<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function avatar()
    {
        return view('users.avatar');
    }

    public function changeAvatar(Request $request)
    {
        $file = $request->file('img');
        $filename = md5(time().user()->id).'.'.$file->getClientOriginalExtension();
        $filepath = '/avatars/'.$filename;
        $file->move($filepath);
        user()->avatar = $filepath;
        user()->save();
        return ['avatar'=>user()->avatar];
    }
}
