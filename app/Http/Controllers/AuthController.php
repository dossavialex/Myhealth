<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
     public function send_Notification(){
        $user = User::find(Auth::guard('web')->user()->id);
        $user->notify();
     }
}
