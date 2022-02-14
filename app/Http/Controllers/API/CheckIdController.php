<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CheckIdController extends Controller
{

    public function checkId(Request $request){

            $request->validate([
                'checkEmail' => 'bail|string|email',
            ]);

            
            if(!User::where('email', '=', $request->checkEmail)->exists()) {
                $checkEmail = 'ok';
                return $checkEmail;
            }
    
            else {
                $checkEmail = 'duplicate';
                return $checkEmail;
            }

    }

}
