<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{
    public function returnProfile(Request $req)
    {
        $id = $req->get('id');

        $user_info = DB::table('users')->where('id' , $id)
        ->select('name' , 'username' , 'profile_photo_path')
        ->get();

        return view('profile')
        ->with('userId' , $id)
        ->with('user_info' , $user_info);
    }
}


