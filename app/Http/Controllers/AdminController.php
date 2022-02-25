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
use App\Models\City;
use App\Models\County;
use App\Models\LocalCode;


class AdminController extends Controller
{

    public function getAdminDatas(Request $request){


        $keyword = null;

        $storeNameKeyword = $request->storeName;
        $storeTelephoneNumber = $request->storeTelephoneNumber;
        $categoryId = $request->adminCategory;
        $cityId = $request->adminCity;
        $countyId = $request->adminCounty;

        $filtered_stores = Store::select();

        if($storeNameKeyword != null){
            $filtered_stores = Store::where('name', 'like', "%{$storeNameKeyword}%");
        }
        elseif($storeTelephoneNumber != null){
            $filtered_stores = Store::where('telephone_number', 'like', "%{$storeTelephoneNumber}%");
        }
        // else{
        //     $filtered_stores = Store::select();
        // }

        // dump($storeNameKeyword);
        // dump($storeTelephoneNumber);
        // dump($categoryId);
        // dump($cityId);
        // dump($countyId);
        // dump($filtered_stores->count());

        if($categoryId != null){
            $filtered_stores->where('category_id', $categoryId);
        }
        if($countyId != null && $countyId != 'none'){
            $filtered_stores->where('county_id', $countyId);
        }


        // check!!!!!!!!!!!!!!!!!!
        else{
            if($cityId != null){
                $filteredCounties = City::find($cityId)->counties()->get();
                // dump($filtered_stores);
                foreach($filteredCounties as $filteredCounty){
                    // dump($filteredCounty->id);
                    $filtered_stores->where('county_id', $filteredCounty->id);
                }
            }
        }




        // elseif($countyId == null && $cityId != null){
            
        //     $filteredCounties = City::find($cityId)->counties()->get();
        //     $countiesIdList = $filteredCounties->pluck('county_id');
        //     dump($filteredCounties->count());
        //     dump($countiesIdList);
            
        //     if($countiesIdList->count() == 0){
        //         $filtered_stores->where('county_id', 999999);
        //     }

        //     elseif($countiesIdList->count() ==1){
        //         $filtered_stores->where('county_id', $countiesIdList->first());
        //     }
            
        // }

        // elseif($countyId == 'none' && $cityId != null){

        //         $filteredCounties = City::find($cityId)->counties()->get();
        //         $countiesIdList = $filteredCounties->pluck('county_id');
        //         dump($countiesIdList);
        //         $filtered_stores->whereIn('county_id', $countiesIdList);
        //         dump($filtered_stores->count());
        //     }


            // if($filteredCounties->count() == 0){
            //     $filtered_stores->where('county_id', 999999);
            // }
            // elseif($filteredCounties->count() == 1){
            //     $filtered_stores->where('county_id', $filteredCounties->first()->id);
            // }
            // else{
            //     $filtered_stores->whereIn('county_id', $filteredCounties);
            // }

        $filtered_stores = $filtered_stores->paginate(5);
        $stores = $filtered_stores;

        $categories = Category::get();
        $cities = City::with(['counties'])->get();
        $counties = County::get();
        

        return view('admin/admin', [

            'keyword' => $keyword,
            'stores' => $stores,
            'categories' => $categories,
            'cities' => $cities,
            'counties' => $counties

            

        ]);

    }




    public function getRegistDatas(Request $request){

        $keyword = null;
        
        $categories = Category::get();
        $cities = City::with(['counties'])->get();
        $counties = County::get();
        $localCodes = LocalCode::get();
        $file = $request->file('inputFile1');
        $test = $request->all();
        dump($file);

        return view('admin/registStore', [

            'keyword' => $keyword,
            'categories' => $categories,
            'cities' => $cities,
            'counties' => $counties,
            'localCodes' => $localCodes
            

        ]);

    }


    public function registStores(Request $request){

        $file = $request->file('inputFile1');
        $test = $request->all();
        dump($test);
        // dd($test);
        ///
        try {

            $request->validate([
                'storeName' => 'bail|required|between:1,30',
                'storeIntro' => 'bail|required|between:10,300',
                'category_id' => 'bail|required|',
                'adminCity' => 'bail|required|',
                'adminCounty' => 'bail|required|',
                'addressDetail' => 'bail|required|',
                'localCode' => 'bail|required|',
                'middleNumber' => 'bail|required|',
                'lastNumber' => 'bail|required|',
                'category_id' => 'bail|required|',
            ]);
            

//test

// $list = $request -> all();
// $i = 0;
// $flag = 0;
// foreach ($list as $key => $value) {
//     if(strpos($key,'recordStoreImage') !== false && $value !== null ) {
//         $flag=1;
//         break;
//     }

    //

            
            DB::beginTransaction();
                        
            
            // if ($store->id !== intval($request->storeId)) {
            //     Session::flash('error', '올바르지않은 접근방법입니다.');
            //     return redirect()->back();
            // }

            $telephoneNumber = $request->middleNumber.$request->lastNumber;
            
            Store::insert(['name' =>$request->storeName, 'introduction' => $request->storeIntro, 'category_id' => $request->category_id, 'address_detail' => $request->addressDetail,
            'county_id' => $request->adminCounty, 'local_code_id' => $request->localCode, 'telephone_number' => $telephoneNumber, 'rating_average' => 0.0, 'review_count' => 0]);
                        
            
            DB::commit();

            return redirect()->back()->with('success','맛집이 추가되었습니다.');;
            
        } 
        catch (\Exception $exception) {
            DB::rollback();
            Session::flash('error', $exception->getMessage());
            throw $exception;
        }

///

        // return view('admin/registStore', [

        //     'keyword' => $keyword,
        //     'categories' => $categories,
        //     'cities' => $cities,
        //     'counties' => $counties,
        //     'localCodes' => $localCodes
            

        // ]);

    }



    public function deleteStore(Request $request){

        $keyword = null;


        try {
            // $request->validate([
            //     'reviewId' => 'bail',
            //     'reviewTitle' => 'bali',
            //     'reviewContents' => 'bali',
            // ]);
            
            DB::beginTransaction();
            
            $store = Store::find($request->id);
            
            $store->delete();
            
            DB::commit();

            return redirect()->back()->with('success','스토어가 삭제되었습니다.');;
            
        } 
        catch (\Exception $exception) {
            DB::rollback();
            Session::flash('error', $exception->getMessage());
            throw $exception;
        }
        
    }


}
