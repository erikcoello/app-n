<?php

namespace App\Http\Controllers;

use App\Mail\MessageReceived;
use Illuminate\Support\Facades\Mail;

//use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store() {
     $message =   request()->validate([
            'name' => 'required|min:3',
            'email'=> 'required|email',
            'subject' => 'required',
            'content' => 'required|min:5',
     ], 



     [ 'name.required' => __('I need you name')
     ]);

        Mail:: to ('surfing.emotions@gmail.com')->queue(new MessageReceived($message));
       // return new MessageReceived($message);

        return back()->with('status','Recibimos tu mensaje, te responderemos en menos de 24 horas');
    }
}
