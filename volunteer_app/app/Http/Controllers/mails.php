<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class mails extends Controller
{
    public function sendEmailReminder()
    {
        //$user = Auth::user()->id;
        $data =array(['name'=>'test','version'=>'Development status']);
        Mail::send('welcome', $data, function ($message) {
            $message->from('elidorv@outlook.com', 'Laravel')->to('elidor.varosi@cit.edu.al')->cc('elidorv@outlook.com')->subject('test');
        });
    }
}
