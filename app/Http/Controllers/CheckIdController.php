<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CheckIdController extends Controller
{

    public function checkId(Request $request){

            $request->validate([
                'checkId' => 'bail|string|email',
            ]);

            if(!User::where('email', '=', $request->checkId)->exists()) {
                return response()->json(['status' => 'ok']);
            }
    
            else {
                return response()->json(['status' => 'duplicate']);
            }

    }

}
