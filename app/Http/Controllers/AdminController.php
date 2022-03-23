<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Store;
use App\Models\Image;
use App\Models\Review;
use App\Models\Wish;
use App\Models\City;
use App\Models\County;
use App\Models\LocalCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;


class AdminController extends Controller
{

    public function getAdminDatas(Request $request){


        $storeNameKeyword = $request->storeName;
        $storeTelephoneNumber = $request->storeTelephoneNumber;
        $categoryId = $request->adminCategory;
        $cityId = $request->adminCity;
        $countyId = $request->adminCounty;

        $filtered_stores = Store::select();

        // 키워드 검색
        if($storeNameKeyword != null){
            $filtered_stores = Store::where('name', 'like', "%{$storeNameKeyword}%");
        }
        elseif($storeTelephoneNumber != null){
            $filtered_stores = Store::where('telephone_number', 'like', "%{$storeTelephoneNumber}%");
        }

        // 카테고리 검색
        if($categoryId != null){
            $filtered_stores->where('category_id', $categoryId);
        }

        // 주소 검색

        // whereHas 사용 !!
        if($cityId){
            $filtered_stores->whereHas('county.city', function($query) use($cityId){
                $query->where('id', $cityId);
            });
            if($countyId != null && $countyId != 'none'){
                $filtered_stores->where('county_id', $countyId);
            }
        }

        $filtered_stores = $filtered_stores->paginate(5);
        $stores = $filtered_stores;
        $categories = Category::get();
        $cities = City::with(['counties'])->get();
        $counties = County::get();
        
        return view('admin/admin', [
            'stores' => $stores,
            'categories' => $categories,
            'cities' => $cities,
            'counties' => $counties
        ]);

    }

    public function getRegistDatas(Request $request){

        $categories = Category::get();
        $cities = City::with(['counties'])->get();
        $localCodes = LocalCode::get();        

        return view('admin/registStore', [
            'categories' => $categories,
            'cities' => $cities,
            'localCodes' => $localCodes
        ]);

    }


    public function registStores(Request $request){



        try {
        
            // inputFiles[] 배열로??
            $fileRules = [];
            for($i=1; $i<=5; $i++){
                $isRequired = $i === 1 ? 'required' : 'nullable';
                $fileRules["inputFile{$i}"] = "bail|{$isRequired}|file|mimes:jpeg,jpg,bmp,png";
            }

            $request->validate(array_merge([
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
            ], $fileRules));


            DB::beginTransaction();
            
            $telephoneNumber = $request->middleNumber.$request->lastNumber;
            
            $storeId = Store::insertGetId(['name' => $request->storeName, 'introduction' => $request->storeIntro, 'category_id' => $request->category_id, 'address_detail' => $request->addressDetail,
            'county_id' => $request->adminCounty, 'local_code_id' => $request->localCode, 'telephone_number' => $telephoneNumber, 'rating_average' => 0.0, 'review_count' => 0]);

            // 이미지등록
            $input = $request->all();
            for($i=1;$i<=5;$i++){
                if($request->hasFile('inputFile'.$i)){
                    $destination_path = 'public/images';
                    $image = $request->file('inputFile'.$i);
                    $image_name = 'store_Img_'.$storeId.'-'.$i.'.'.$image->extension();
                    $request->file('inputFile'.$i)->storeAs($destination_path, $image_name);
                    $path = '/storage/images/'.$image_name;
                    Image::insert(['path' => $path, 'store_id' => $storeId]);
                    $input['inputFile'.$i] = $image_name;
                }
            }
    
            DB::commit();
            
            return redirect()->back()->with('success','맛집이 추가되었습니다.');;
            
        } 
        catch (\Exception $exception) {
            DB::rollback();
            Session::flash('error', $exception->getMessage());
            throw $exception;
        }
    }


    
    public function getModifyStoresDatas(Request $request){

        $store = Store::with(['images','category','county','localCode'])->find($request->storeId);
        $middleNumber = substr($store->telephone_number,0,-4);
        $lastNumber = substr($store->telephone_number, -4);
        $categories = Category::get();
        $cities = City::get();
        $counties = County::where('city_id',$store->county->city->id)->get();
        $localCodes = LocalCode::get();
        $store->get();


        return view('admin/modifyStore', [

            'store' => $store,
            'categories' => $categories,
            'cities' => $cities,
            'counties' => $counties,
            'localCodes' => $localCodes,
            'middleNumber' => $middleNumber,
            'lastNumber' => $lastNumber
    ]);
    }

    public function modifyStores(Request $request){

        // dd($request->fileNamePk);

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
            
            
            DB::beginTransaction();

            $store = Store::with(['images','category','county','localCode'])->find($request->storeId);
            $storeId = $request->storeId;
            $telephoneNumber = $request->middleNumber.$request->lastNumber;

            Store::find($storeId)->update(['name' => $request->storeName, 'introduction' => $request->storeIntro, 'category_id' => $request->category_id, 'address_detail' => $request->addressDetail,
            'county_id' => $request->adminCounty, 'local_code_id' => $request->localCode, 'telephone_number' => $telephoneNumber]);

            
            // 이미지 이름 추출
            $imageNames = array(0 => "", 1 => "", 2 => "", 3 => "", 4 => "");
            foreach($store->images as $image){
                $name = $image->path;
                $name = str_replace('/storage/images/','',$image->path);
                $name = str_replace('/images/','',$name);
                
                switch(true){
                    case (strpos($name, '-1')):
                        $imageNames[0] = $name;
                        break;
                    case (strpos($name, '-2')):
                        $imageNames[1] = $name;
                        break;
                    case (strpos($name, '-3')):
                        $imageNames[2] = $name;
                        break;
                    case (strpos($name, '-4')):
                        $imageNames[3] = $name;
                        break;
                    case (strpos($name, '-5')):
                        $imageNames[4] = $name;
                        break;
                    }
                }

                // $fileNameList = explode(",", $request->fileNameList);
                $fileNamePks = explode(",", $request->fileNamePk);
            
            
            // 이미지 삭제 및 등록
            $input = $request->all();

            // PK의 이미지 삭제 및 DB삭제
            if($fileNamePks[0] != ''){
                foreach($fileNamePks as $index => $fileNamePk){
                    if($fileNamePk != 'none'){
                    $imagequery = Image::find($fileNamePk);
                    // dd($imagequery);
                    // dd(File::delete(public_path($imagequery->path)));
                    File::delete(public_path($imagequery->path));
                    $imagequery->delete();
                    }
                }
            }
            
            // 이미지 순서에 따라 이미지 이름 변경
            $newImages = $store->images()->get();
            foreach($newImages as $index => $image){
                $nameIndex = intval((substr($image->path, -5, 1)))-1;
                if($nameIndex != $index){
                    $newName = (substr($image->path, 0, -5)).($index+1).(substr($image->path, -4, 4));
                    File::move(public_path($image->path), public_path($newName));
                    Image::find($image->id)->update(['path' => $newName]);
                }
            }

            // // DB의 파일명이 $fileName에 없으면 삭제한다.

            // $diffrentFiles = array_diff($imageNames, $fileNameList);
            // foreach($diffrentFiles as $index => $diffrentFileName){
            //     if($diffrentFileName != 'new' || $diffrentFileName != 'none' || $diffrentFileName != ''){
            //         if(Image::where('path', '/storage/images/'.$diffrentFileName)->exists()){
            //             $imagedeletequery = Image::where('path', '/storage/images/'.$diffrentFileName)->first();
            //             $imagedeletequery->delete();
            //             Storage::disk('images')->delete($diffrentFileName);
            //         }
            //         elseif(Image::where('path', '/images/'.$diffrentFileName)->exists()){
            //             $imagedeletequery = Image::where('path', '/images/'.$diffrentFileName)->first();
            //             $imagedeletequery->delete();
            //             File::delete(public_path('images/'.$diffrentFileName));
            //         }
            //     }
            // }

            // // DB의 파일명이 순서와 다르면 파일이름을 변경한다.
            // foreach($fileNameList as $index => $fileName){
            //     if($fileName != 'new' || $fileName != 'none'){
            //         $fileNameIndex = intval(substr($fileName, -5, 1));
            //         if($fileNameIndex > $index+1){
            //             $imageNewName = 'store_Img_'.$storeId.'-'.($index+1).'.png';
            //                 if(Image::where('path', '/storage/images/'.$fileName)->exists()){
            //                     $imageupdatequery = Image::where('path', '/storage/images/'.$fileName)->update(['path' => '/storage/images/'.$imageNewName]);
            //                     if(Storage::disk('images')->exists($imageNewName)){
            //                         Storage::disk('images')->delete($imageNewName);
            //                     }
            //                     Storage::disk('images')->move($fileName, $imageNewName);
            //                 }
            //                 elseif(Image::where('path', '/images/'.$fileName)->exists()){
            //                     $imageupdatequery = Image::where('path', '/images/'.$fileName)->update(['path' => '/storage/images/'.$imageNewName]);
            //                     $overwriteFile = public_path('images/'.$fileName);
            //                     if(Storage::disk('images')->exists($imageNewName)){
            //                         Storage::disk('images')->delete($imageNewName);
            //                     }
            //                     copy($overwriteFile, public_path('storage/images/'.$imageNewName));
            //                     File::delete($overwriteFile);
            //                 }
    
            //         }
            //     }
            // }
            

            // 이미지등록
            for($i=0;$i<5;$i++){
                if($request->hasFile('inputFile'.($i+1))){
                    $destination_path = 'public/images';
                    $image = $request->file('inputFile'.($i+1));
                    $image_name = 'store_Img_'.$storeId.'-'.($i+1).'.'.$image->extension();
                    $request->file('inputFile'.($i+1))->storeAs($destination_path, $image_name);
                    $path = '/storage/images/'.$image_name;
                    Image::insert(['path' => $path, 'store_id' => $storeId]);
                    $input['inputFile'.($i+1)] = $image_name;
                }
            }
            
    
            DB::commit();
            
            return redirect()->back()->with('success','맛집이 수정되었습니다.');
            
        } 
        catch (\Exception $exception) {
            DB::rollback();
            Session::flash('error', $exception->getMessage());
            Log::error($exception->getMessage());
            throw $exception;
        }
    }


    public function deleteStore(Request $request){

        // 찜 있을시 제외
        $user_id = Wish::where('store_id', $request->id)->exists();
        
        if(Wish::where('store_id', $request->id)->exists()){
            Session::flash('error', '스토어의 찜을 삭제해주세요.');
            return response()->json(['status' => 'failed']);

        }
        
        if(Review::where('store_id', $request->id)->exists()){
            Session::flash('error', '스토어의  리뷰를 삭제해주세요.');
            return response()->json(['status' => 'failed']);
        }
        
    try {
            
            DB::beginTransaction();
            
            // 스토어 찾기
            $store = Store::find($request->id);
            
            // 이미지 삭제
            $imageNames = array();
            foreach($store->images as $image){
                $name = str_replace('/storage/images/','',$image->path);
                array_push($imageNames, $name);
            }
            $imageCount = count($imageNames);
            
            for($i=0;$i<$imageCount;$i++){
                Storage::disk('images')->delete(basename($imageNames[$i]));
            }
            
            // 이미지 DB삭제
            $image = Image::where('store_id', $request->id);
            $image->delete();
            
            // // 리뷰삭제
            // $reviews = Review::where('store_id', $request->id);
            // $reviews->delete();

            // // 찜삭제
            // $wishes = Wish::where('store_id', $request->id);
            // $wishes->delete();

            // 스토어 삭제
            $store->delete();
            
            DB::commit();
            Session::flash('success', '스토어가 삭제되었습니다.');

            return response()->json(['status' => 'ok']);
        } 
        catch (\Exception $exception) {
            DB::rollback();
            Session::flash('error', $exception->getMessage());
            throw $exception;
        }
    }
}
