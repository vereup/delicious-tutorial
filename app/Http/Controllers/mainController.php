<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Store;
use App\Models\Image;
use App\Models\Wish;


class MainController extends Controller
{
    public function getMainDatas(Request $request){

        
        $user_id = Auth::id();
        $categories = Category::get();
        $stores = Store::get();
        $images = Image::get();
        $wishes = Wish::get();
        $userWishes = Wish::where('user_id', $user_id)->get();


        return view('master', [
            'categories' => $categories,
            'stores' => $stores,
            'images' => $images,
            'wishes' => $wishes,
            'user_id' => $user_id,
            'userWishes' => $userWishes
        ]);

    }


    public function removeWish(Request $request){



        try {
            // $request->validate([
            //     'reviewId' => 'bail',
            //     'reviewTitle' => 'bali',
            //     'reviewContents' => 'bali',
            // ]);
            
            DB::beginTransaction();
            
            $wish = Wish::where('store_id', $request->storeId);
            
            $wish->delete();
            
            DB::commit();

            return redirect()->back()->with('success','찜이 삭제되었습니다.');;
            
        } 
        catch (\Exception $exception) {
            DB::rollback();
            Session::flash('error', $exception->getMessage());
            throw $exception;
        }
        
    }


    public function addWish(Request $request){

        $user_id = Auth::id();


        try {
            // $request->validate([
            //     'reviewId' => 'bail',
            //     'reviewTitle' => 'bali',
            //     'reviewContents' => 'bali',
            // ]);
            
            DB::beginTransaction();
            
            $wish = Wish::insert(
                ['user_id' => $user_id, 'store_id' => $request->storeId]);
            
            DB::commit();

            return redirect()->back()->with('success','찜이 삭제되었습니다.');;
            
        } 
        catch (\Exception $exception) {
            DB::rollback();
            Session::flash('error', $exception->getMessage());
            throw $exception;
        }
        
    }

    public function category(Request $request){


        dump($request->categoryList);

        $user_id = Auth::id();
        $categories = Category::get();
        $stores = Store::get();
        $images = Image::get();
        $wishes = Wish::get();
        $userWishes = Wish::where('user_id', $user_id)->get();

        $selectCategory = $request->categoryList;

        return view('master', [
            'categories' => $categories,
            'stores' => $stores,
            'images' => $images,
            'wishes' => $wishes,
            'user_id' => $user_id,
            'userWishes' => $userWishes
        ]);


    }

    public function rating(Request $request){

        dump($request->ratingList);

    }

    public function search(Request $request){

        dump($request->keyword);

    }


}
