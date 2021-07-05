<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoggedOut extends Controller
{
    public function changeActiveStatus()
    {
        return "logged out";
    }
}
