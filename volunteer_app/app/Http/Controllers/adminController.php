<?php

namespace App\Http\Controllers;

use App\posts;
use App\profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    //Can either set the post approved or not depending on the request
    function approvePost(Request $request){
        $user_id =Auth::user()->id;
        $isAdmin = profile::where('id',$user_id)->value('isAdmin');

        if($isAdmin){
            $post = $request->validate([
                'id' => 'required|integer',
                'isApproved'=>'required|boolean',
            ]);
            $id=$request->id;

            //Find if the conditions are met then updates the information

            posts::where('id', $id)
                ->update($post);
            return 200;

        }
        else
            return 401;
    }

    function approveAccount(Request $request){
        $user_id =Auth::user()->id;
        $isAdmin = profile::where('id',$user_id)->value('isAdmin');

        if($isAdmin){
            //Validates that the request got an id and approval boolean
            $user = $request->validate([
                'id' => 'required|integer',
                'isApproved'=>'required|boolean',
            ]);

            $id=$request->id;

            //Updates the profile
            profile::where('id', $id)->update($user);
            return 200;

        }
        else
            return 401;
    }
}
