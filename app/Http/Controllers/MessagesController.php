<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MessagesController extends Controller
{
    public function returnMessageInterface(Request $req)
    {
        $receiver_id = $req->get('receiver_id');

        $receiver_details = User::where('id' , $receiver_id)
        ->select('username' , 'profile_photo_path')
        ->get();

        return view('messages')
        ->with('receiver_id' , $receiver_id)
        ->with('receiver_details' , $receiver_details);
    }
}



