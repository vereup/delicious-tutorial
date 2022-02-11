<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SignupController extends Controller
{

    public function getSignupDatas(Request $request){

        $keyword = null;
        return view('signup', [
            'keyword' => $keyword
        ]);
    }


    public function checkId(Request $request){

        

            $request->validate([
                'checkEmail' => 'bail|string',
            ]);

            
            if(!DB::table('users')->where('email', '=', $request->checkEmail)->exists()) {
                $checkEmail = 'ok';
                return $checkEmail;
            }
    
            else {
                $checkEmail = 'duplicate';
                return $checkEmail;
            }

    }


    // public function singup(Request $request){



    //     try {

    //         $request->validate([
    //             'checkEmail' => 'bail|required|string',
    //             'password' => 'bail|required|string',
    //             'name' => 'bail|required|string',
    //         ]);
            
    //         DB::beginTransaction();
            
    //         $user = User::insert(['user_id' =>$user_id, 'store_id' => $request->storeId, 'title' => $request->title, 
    //         'contents' => $request->contents, 'been_date' => $request->reviewDate, 'rating' => $request->rating]);

                        
    //         DB::commit();

    //         return redirect()->back()->with('success','리뷰가 추가되었습니다.');;
            
    //     } 
    //     catch (\Exception $exception) {
    //         DB::rollback();
    //         Session::flash('error', $exception->getMessage());
    //         throw $exception;
    //     }

    // }


}
