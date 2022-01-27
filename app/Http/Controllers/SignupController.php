<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class SignupController extends Controller
{
    public function getSignupDatas(Request $request){


        $users= User::get();

        return view('signup', [

        ]);

    }
}
