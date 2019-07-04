<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
Use User;

class UserController extends Controller
{
    //
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile',['user'=>$user]);
    }


    public function update_avatar(Request $request){
        $user = Auth::user();
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile("avatar")){
            if(Input::hasFile("avatar")){
                $file=Input::file("avatar");
                $file->move(public_path()."/uploads/avatars/",$file->getClientOriginalName());
                $url=URL::to("/") ."/uploads/avatars/".$file->getClientOriginalName();
                $user->avatar=$url;
                $user->save();
                //return back()
                    //->with('success','You have successfully upload image.');
                return view('user.profile',['user'=>$user]);
            }

            //$avatar=$request->file("avatar");
            //$avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

            //$file=Input::file("avatar");
            //$file->move(public_path("uploads/avatars".$avatarName));
            //Image::make($avatar)->resize(300,300)->save(public_path("/uploads/avatars" .$avatarName));
            //$user->avatar=$avatarName;
            //$user->save();

        }

    }
}
