<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\FuncCall;

class contactController extends Controller
{ 
    public function contact()
    {
        return view('contact');
    }
    public function sendEmail(Request $request){
        $details=[
            'name'=> $request -> name,
            'email'=>$request -> email,
            'phone'=>$request ->phone,
            'msg'=> $request -> msg
        ];
        Mail::to('mforuminfo@gmail.com')-> send(new ContactMail($details));
        return back()-> with('message_sent','your message has been sent successfully!');

    }
}
