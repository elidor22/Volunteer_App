<?php

namespace App\Http\Controllers;

use App\posts;
use Illuminate\Http\Request;
use App\tags;
use App\article_tags;
use App\user_tags;
use Illuminate\Support\Facades\Auth;

class user_feed extends Controller
{
    public function favourite_tags(){
        $user_id =Auth::user()->id;
        $usertags = user_tags::where('user_id', $user_id)->pluck('tag_id');

        return $usertags;
    }

    public function article_tags(){
        $tags = $this->favourite_tags();
        $postarray = [];
        $i = 0;
        foreach ($tags as $tag){
            $post = article_tags::where('tag_id', $tag)->pluck('post_id');
            foreach($post as $postt){
                $postarray[$i]=$postt;
                $i+=1;
            }

        }
        $debugarray = [];
        $debugarray[0]=$tags;
        $debugarray[1]=$postarray;
        return $postarray;
    }

    public function return_posts(){
        $post_id = $this->article_tags();
        $i = 0;
        $postarray =[];
        foreach ($post_id as $id){
            //Adds only the approved posts
            $postarray[$i]=posts::where('id', $id)->where('isApproved',true)->get()->toArray();
            $i+=1;

        }
        //Removes the empty arrays than are generated during the iteration
        $array= array_filter(array_map('array_filter', $postarray));
        //Returns only unique results, so the same article, will not be returned multiple time if it has multiple tags
        $result = array_map("unserialize", array_unique(array_map("serialize", $array)));

        $debugarray = [];
        $debugarray[0]=$post_id;
        $debugarray[1]=$result;
    return $result;
    }
}
