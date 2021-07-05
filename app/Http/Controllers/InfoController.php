<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\DB;

class InfoController extends Controller
{
    public function returnInfo(Request $request)
    {
        $search = json_decode(json_encode($request->json()->all()))->search;

        $only = ['id' , 'name' , 'username' , 'email'];

        $find_uname = User::select($only)->where('username' , $search)->orWhere('username' , 'like' , '%' . $search . '%')->get();

        return json_encode($find_uname);

    }
}




