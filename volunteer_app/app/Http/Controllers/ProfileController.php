<?php

namespace App\Http\Controllers;

use App\profile;
use App\posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
       return profile::all();
    }


    public function create(Request $request)
    {
        $id =Auth::user()->id;
        $email=Auth::user()->email;
        $profile = new profile([
            'id' => $id,
            'email' => $email,
            'name' => $request->name,
            'surname' => $request->surname,
            'username' => $request->username,
            'profile_photo_url'=>$request->profile_photo_url,
        ]);
        $profile->save();
        return $profile;
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
    $profile = profile::where('id', Auth::user()->id)->get();

    return $profile;
    }
    //Returns posts of the logged in user
    public function showPosts(Request $request)
    {
        $user_id =auth()->user()->id;
        $posts = posts::where('post_id', auth()->user()->id)->get();

        return $posts;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(profile $profile)
    {
        //
    }
}
