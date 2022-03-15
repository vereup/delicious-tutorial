<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SignupController extends Controller
{

    public function getSignupDatas(Request $request){

        return view('signup');
    }


}
