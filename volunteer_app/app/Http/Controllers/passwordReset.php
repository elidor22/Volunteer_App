<?php

namespace App\Http\Controllers;

use App\profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\resetCode;
use App\User;
class passwordReset extends Controller
{
    function resetPassword(Request $request){
        $username = profile::where('email', $request->email)->value('name');
        $email = $request->email;
        $code ='This is your reset code';
        //Just e placeholder code
        $code.='fafadfadfdafaefrefcsadf';
        $code.=$username;
        Mail::raw($code, function($message) use ($email, $request, $username) {
            $message->to($email, 'Password reset')->subject
            ('Password reset code');
            $message->from('VolunteereApp@Tytanyum.com',$username);
        });
        return 200;

    }

    function savePassword(Request $request){
        $email = $request->email;
        $code = $request->code;
        //Gets the code from the database
        $realCode=resetCode::where('email', $request->email)->value('code');

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
}
