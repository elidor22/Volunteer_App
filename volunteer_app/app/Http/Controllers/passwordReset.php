<?php

namespace App\Http\Controllers;

use App\profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\resetCode;
use App\User;
class passwordReset extends Controller
{
    function sendCode(Request $request){
        $username = profile::where('email', $request->email)->value('name');
        $email = $request->email;
        $code ='This is your code: ';
        //Just e placeholder code
        $confirmationCode=$this->generateRandomString(6);
        $code.=$confirmationCode;
        Mail::raw($code, function($message) use ($email, $request, $username) {
            $message->to($email, 'Confirmation code')->subject
            ('Use this code to proceed with your request');
            $message->from('VolunteereApp@Tytanyum.com',$username);
        });
        $reset = new resetCode([
            'email'=>$email,
            'code'=>$confirmationCode,
        ]);
        $reset->save();
        return 200;

    }

    function savePassword(Request $request){
        $code = $request->code;
        //Gets the code from the database, always selects the latest code
        $realCode=resetCode::where('email', $request->email)->latest()->value('code');

        //Checks if the right code was entered
        if($code==$realCode){
            $password = $request->validate([
                'password'=> 'required|string',]);
            $email = $request->email;

            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $password['password']=$input['password'];

            user::where('email',$email)->update($password);

            Mail::raw('Password changed', function($message) use ($email) {
                $message->to($email, 'Password changed')->subject
                ('Your password just changed');
                $message->from('VolunteereApp@Tytanyum.com','Keep calm and use the service now');
            });
            return $realCode;
        }
        else
            return 401;


    }

    //Generates a random string to be used as a verification code
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;

    }

    //TODO: Complete confirm email
    function confirmEmail(Request $request){
    $email = $request->email;


    }
}
