<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user_tags;
use App\tags;
use App\article_tags;
use App\posts;
use Illuminate\Support\Facades\Auth;

class tagsManager extends Controller
{
    function user_tags(){
    $userID = Auth::user()->id;

    //Finds the user_tags where id is equal to our user id
    $tags = user_tags::where('user_id', $userID)->pluck('tag_id');
    $array = $tags->toArray();
    $i =0;

    $ourTags= array();
    //Finds and ads tags one by one during the iteration
    foreach ($array as $tag){
    $tagsArray=tags::where('id',$tag)->pluck('id');
    $ourTags[]=$tagsArray->toArray();
    $i++;

    }


    //Returns users favourite tags
    return $ourTags;
    }

    //Returns the posts with the tags
    function returnPosts(){
    $array =$this->user_tags();
        //Removes empy arrays from the 2d $array
        $array = array_map('array_filter', $array);
        $array = array_filter($array);
        //Finds and ads tags one by one during the iteration
        $ourPosts= array();
        $i=1;

        foreach ($array as $tag){
            //Used $i as it throws an unknown PGSQL error if $tag is used
            $userTags = article_tags::where('tag_id',$i)->pluck('post_id');
            $ourPosts[$i]=$userTags->toArray();
            $i++;
        }
        $iterArray = $ourPosts[1];
        $finalResult = array();
        $j =0;
        foreach ($iterArray as $item) {
            $posts = posts::where('post_id', $item)->get();
            $finalResult[$j]=$posts->toArray();
            $j++;
        }

        //return $posts->toArray();
        return $finalResult;
        //return $iterArray;
        //return $ourPosts;
        //return $array;


    }

}
