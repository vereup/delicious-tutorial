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
        $images = Image::get();
        $wishes = Wish::get();
        $userWishes = Wish::where('user_id', $user_id)->get();
        $rating_1 = null;
        $rating_2 = null;
        $rating_3 = null;
        $rating_4 = null;
        $rating_5 = null;
        $filtered_rating_1 = null;
        $filtered_rating_2 = null;
        $filtered_rating_3 = null;
        $filtered_rating_4 = null;
        $filtered_rating_5 = null;
        $filtered_stores = null;
        $ratingList = array();

        
        $storeCounts = 0;


        // // 검색어입력

        if($request->keyword != null){
            $stores = Store::where('name', $request->keyword)->get();
            $keyword = $request->keyword;
        }

        else{
            $keyword = null;
            $stores = Store::get();
        }



        // 카테고리선택
        
        if($request->categoryList != null ){
            $categoryList = explode(',', $request->categoryList);
            $stores = $stores->whereIn('category_id', $categoryList);
        }

        else{
            $categoryList = 'all';
        }

        // 평점선택

    
            if($request->rating_1 != null){
                $filtered_rating_1 = $stores->whereBetween('rating_average', [0,1]);
                $rating_1 = 'on';
                array_push($ratingList, '1');
                if($filtered_stores != null){
                    $filtered_stores = $filtered_stores->merge($filtered_rating_1);
                }
                else{
                    $filtered_stores = $filtered_rating_1;
                }
            }

            if($request->rating_2 != null){
                $filtered_rating_2 = $stores->whereBetween('rating_average', [1,2]);
                $rating_2 = 'on';
                array_push($ratingList, '2');
                if($filtered_stores != null){
                    $filtered_stores = $filtered_stores->merge($filtered_rating_2);
                }
                else{
                    $filtered_stores = $filtered_rating_2;
                }
    
            }
            if($request->rating_3 != null){
                $filtered_rating_3 = $stores->whereBetween('rating_average', [3,4]);
                $rating_3 = 'on';
                array_push($ratingList, '3');
                if($filtered_stores != null){
                    $filtered_stores = $filtered_stores->merge($filtered_rating_3);
                }
                else{
                    $filtered_stores = $filtered_rating_3;
                }
    
            }
            if($request->rating_4 != null){
                $filtered_rating_4 = $stores->whereBetween('rating_average', [4,5]);
                $rating_4 = 'on';
                array_push($ratingList, '4');
                if($filtered_stores != null){
                    $filtered_stores = $filtered_stores->merge($filtered_rating_4);
                }
                else{
                    $filtered_stores = $filtered_rating_4;
                }
    
            }
            if($request->rating_5 != null){
                $filtered_rating_5 = $stores->whereBetween('rating_average', [5,5]);
                $rating_5 = 'on';
                array_push($ratingList, '5');
                if($filtered_stores != null){
                    $filtered_stores = $filtered_stores->merge($filtered_rating_5);
                }
                else{
                    $filtered_stores = $filtered_rating_5;
                }                
                
    
            }


        if($filtered_stores != null){
            $stores = $filtered_stores;
        }
        
        $storeCounts = $stores->count();



        

    


        return view('master', [
            'categories' => $categories,
            'stores' => $stores,
            'categoryList' => $categoryList,
            'images' => $images,
            'wishes' => $wishes,
            'user_id' => $user_id,
            'userWishes' => $userWishes,
            'storeCounts' => $storeCounts,
            'rating_1' => $rating_1,
            'rating_2' => $rating_2,
            'rating_3' => $rating_3,
            'rating_4' => $rating_4,
            'rating_5' => $rating_5,
            'ratingList' => $ratingList,
            'keyword' => $keyword
            

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


        if($request->categoryList != null){
            $categoryList = explode(',', $request->categoryList);
            $filtered_stores = Store::whereIn('category_id', $categoryList)->get();
        }
        
        else{
            $filtered_stores = 'false';
        }

        // foreach($filtered_stores as $aa){
        //     dump($aa->name);
        // }

        return redirect('home')->with(['stores' => $filtered_stores]);



    }


    public function rating($stores){

        dump($request->rating_1);

        if($request->rating_1 != null){
            $filtered_rating_1 = $stores->whereBetween('rating_average', [0,1]);
            dump($filtered_rating_1);
        }
        if($request->rating_2 != null){
            $filtered_rating_2 = $stores->whereBetween('rating_average', [1,2]);
            dump($filtered_rating_2);

        }
        if($request->rating_3 != null){
            $filtered_rating_3 = $stores->whereBetween('rating_average', [3,4]);
            dump($filtered_rating_3);

        }
        if($request->rating_4 != null){
            $filtered_rating_4 = $stores->whereBetween('rating_average', [4,5]);
            dump($filtered_rating_4);

        }
        if($request->rating_5 != null){
            $filtered_rating_5 = $stores->whereBetween('rating_average', [5,5]);
            dump($filtered_rating_5);

        }

        $stores->merge([$filtered_rating_1, $filtered_rating_2, $filtered_rating_3, $filtered_rating_4, $filtered_rating_5]);


        
        
        dump($request->rating_2);
        dump($request->rating_3);
        dump($request->rating_4);
        dump($request->rating_5);
        
        // $storeCounts = $stores->count();
        // $ratingFilteredStores = Store::whereIn('category_id', $request->categoryList)->get();


    }

    public function search(Request $request){

        $stores = Store::get();


        dump($request->keyword);

        if($request->keyword != null){
            $filtered_keyword = $stores->where('name', $request->keyword);
            dump($filtered_keyword);
        }


    }


}
