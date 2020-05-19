<?php

namespace App\Http\Controllers;

use App\posts;
use App\profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    function approvePost(Request $request){
        $user_id =Auth::user()->id;
        $isAdmin = profile::where('id',$user_id)->value('isAdmin');

        if($isAdmin){
            $post = $request->validate([
                'id' => 'required|integer',
                'isApproved'=>'required|boolean',
            ]);
            $title=$request->id;

            //Find if the conditions are met then updates the information

            posts::where('id', $title)
                ->update($post);
            return 200;

        }
        else
            return 401;
    }
}
