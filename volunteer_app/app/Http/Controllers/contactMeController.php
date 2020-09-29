<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\contact_me;
use Illuminate\Support\Facades\Mail;

class contactMeController extends Controller
{
    public function all(Request $request){
        $applications = contact_me::all();

        return $applications;
    }

    public function contactMe(Request $request){
        $contact = new contact_me([
            'email' => $request->email,
            'name' => $request->name,
            'surname' => $request->surname,
            'phoneNumber' => $request->phoneNumber,
            'Feedback'=>$request->feedback,
            'contactYou'=>$request->contactYou,
            'contacted'=>0,

        ]);
        $email = $request->email;
        $contact->save();
        //Models the email that will be sent
        $text = 'New Contact Request';
        $thePerson ='';
        $thePerson .= $request->name;
        $thePerson .= ' ';
        $thePerson .= $request->surname;
        $text .=$thePerson;
        //Sends the email
        Mail::raw($text, function($message) use ($email,$request) {
            $message->to($email, 'New contact request added from', $request->name, ' ', $request->surname)->subject
            ('New request arrived');
            $message->from('VolunteereApp@Tytanyum.com','Check the latest contact request');
        });

        return 201;

    }
}
