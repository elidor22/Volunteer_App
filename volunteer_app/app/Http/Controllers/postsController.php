<?php

namespace App\Http\Controllers;

use App\profile;
use Illuminate\Http\Request;
use App\posts;
use Illuminate\Support\Facades\Auth;

//TODO:Implement approval check for every route
class postsController extends Controller
{


    function approved(){
        //Finds approved posts where the boolean is true, so has the value of 1, use 0 for not approved posts
        $posts = posts::where('isApproved', 1)->get();
        //$posts = posts::all();
        return $posts;
    }

    //In process posts
    function pendingApproval(){
        //Finds approved posts where the boolean is true, so has the value of 1, use 0 for not approved posts
        $posts = posts::where('isApproved', 0)->where('pendingApproval',1)->get();

        $user_id =Auth::user()->id;
        $isAdmin = profile::where('id',$user_id)->value('isAdmin');
        $userPosts = posts::where('post_id', auth()->user()->id)->get();
        $isApproved =profile::where('id', auth()->user()->id)->value('isApproved');
        //Returns the unapproved posts only to admins that have the permission to see the new unchecked posts
        if($isAdmin){
        return $posts;
        }
        //If the user is approved to post than he/she can track the approvals tatus
        elseif ($isApproved){

            return $userPosts;
        }
        else{
            return 403;
        }

    }

    function declined(){
        //Finds approved posts where the boolean is true, so has the value of 1, use 0 for not approved posts
        $posts = posts::where('isApproved', 0)->where('post_id', auth()->user()->id)->where('pendingApproval',0)->get();
        return $posts;

    }

    function acceptedPost(){
        //Returns all accepted posts for the user
        $posts = posts::where('isApproved', 1)
            ->where('post_id', auth()->user()->id)->where('pendingApproval',0)->get();


        return $posts;

    }


    public function store(Request $request)
    {
        $user_id =Auth::user()->id;
        //Retrieves the boolean value, query
        $isApproved =profile::where('id', auth()->user()->id)->value('isApproved');
        $post = new posts([
            'post_id' => $user_id,
            'title' => $request->title,
            'post' => $request->post,
            'cover_url'=>$request->cover_url,
        ]);

        //Checks if the user has the permission to create posts or not
        $aproval = $isApproved;
        if($aproval){
           $post->save();
           return 201;
        }elseif (!$aproval){
            return 403;
        }

    }
    public function update(Request $request)
    {

        $post = $request->validate([
            'title' => 'required|string',
            'post'=>'required|string',
        ]);
        $title=$request->title;

        //Find if the conditions are met then updates the information

        posts::where('post_id', auth()->user()->id)->where('title', $title)
            ->update($post);


        $id = auth()->user()->id;

        // return auth()->user()->id;
        # code...

        return 200;

    }

    public function delete(Request $request)
    {
        $user_id =Auth::user()->id;
        $title = $request->title;

        $post = posts::where('post_id',$user_id)
            ->where('title', $title);
        $post->delete();

        return "Deleted";
    }


    public function getById($id){
        $post = posts::where('id',$id)->get();

        if($post->isEmpty()){
            return 404;
        }
        else{
            return $post;
        }

    }


}
