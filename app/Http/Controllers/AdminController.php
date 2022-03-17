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
        if($countyId != null && $countyId != 'none'){
            $filtered_stores->where('county_id', $countyId);
        }

        else{
            if($cityId != null){
                $filteredCountiesId = City::find($cityId)->counties()->get()->pluck('id');
                $filtered_stores->whereIn('county_id', $filteredCountiesId);
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
        $counties = County::get();
        $localCodes = LocalCode::get();        

        return view('admin/registStore', [
            'categories' => $categories,
            'cities' => $cities,
            'counties' => $counties,
            'localCodes' => $localCodes
        ]);

    }


    public function registStores(Request $request){


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


            // 이미지 파일 유효성검사 ??
            // for($i=1;$i<=5;$i++){
            //     if($request->hasFile('inputFile'.$i)){
            //         $request->validate([
            //             'inputFile'.$i => 'file|mimes:jpeg, jpg, bmp, png',
            //         ]);
            //     }
            // }

                    
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
        $city = $store->county->city->id;
        $counties = County::where('city_id',$city)->get();
        $localCodes = LocalCode::get();
        $store->get();

        // 이미지 이름 추출
        $imageNames = array(0 => "", 1 => "", 2 => "", 3 => "", 4 => "");
        foreach($store->images as $image){
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
        

        return view('admin/modifyStore', [

            'store' => $store,
            'categories' => $categories,
            'cities' => $cities,
            // 'city' => $city,
            'counties' => $counties,
            'localCodes' => $localCodes,
            'middleNumber' => $middleNumber,
            'lastNumber' => $lastNumber,
            'images' => $store->images,
            'imageNames' => $imageNames
    ]);
    }

    public function modifyStores(Request $request){

        
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

                                    
            // $deleteFileList = explode(",", $request->deletedFileList);

            // $changedFileList = explode(",", $request->changedFileList);

            $fileNameList = explode(",", $request->fileNameList);

            // dd($fileNameList);

            // $orderList = explode(",", $request->orderList);

            
            
            // 이미지 삭제 및 등록
            $input = $request->all();

            
            // 수정중
            
            // DB의 파일명이 $fileName에 없으면 삭제한다.

            $diffrentFiles = array_diff($imageNames, $fileNameList);

            foreach($diffrentFiles as $index => $diffrentFileName){
                if($diffrentFileName != 'new' || $diffrentFileName != 'none' || $diffrentFileName != ''){
                    if(Image::where('path', '/storage/images/'.$diffrentFileName)->exists()){
                        $imagedeletequery = Image::where('path', '/storage/images/'.$diffrentFileName)->first();
                        $imagedeletequery->delete();
                        Storage::disk('images')->delete($diffrentFileName);
                    }
                    elseif(Image::where('path', '/images/'.$diffrentFileName)->exists()){
                        $imagedeletequery = Image::where('path', '/images/'.$diffrentFileName)->first();
                        $imagedeletequery->delete();
                        File::delete(public_path('images/'.$diffrentFileName));
                    }
                }
            }

            // DB의 파일명이 순서와 다르면 파일이름을 변경한다.
            foreach($fileNameList as $index => $fileName){
                if($fileName != 'new' || $fileName != 'none'){
                    $fileNameIndex = intval(substr($fileName, -5, 1));
                    if($fileNameIndex > $index+1){
                        $imageNewName = 'store_Img_'.$storeId.'-'.($index+1).'.png';
                            if(Image::where('path', '/storage/images/'.$fileName)->exists()){
                                $imageupdatequery = Image::where('path', '/storage/images/'.$fileName)->update(['path' => '/storage/images/'.$imageNewName]);
                                if(Storage::disk('images')->exists($imageNewName)){
                                    Storage::disk('images')->delete($imageNewName);
                                }
                                Storage::disk('images')->move($fileName, $imageNewName);
                            }
                            elseif(Image::where('path', '/images/'.$fileName)->exists()){
                                $imageupdatequery = Image::where('path', '/images/'.$fileName)->update(['path' => '/storage/images/'.$imageNewName]);
                                $overwriteFile = public_path('images/'.$fileName);
                                if(Storage::disk('images')->exists($imageNewName)){
                                    Storage::disk('images')->delete($imageNewName);
                                }
                                copy($overwriteFile, public_path('storage/images/'.$imageNewName));
                                File::delete($overwriteFile);
                            }
    
                    }
                }
            }
            


            // dd($imageNames[0]);

            // $maxFileCount = 0;
            // foreach($imageNames as $imageName){
            //     if($imageName != ""){
            //         $maxFileCount = $maxFileCount + 1;
            //     }
            // }

            // $j = 5;
            // //파일수만큼
            // for($i=0;$i<$maxFileCount;$i++){

            //     //파일이름을 하나씩 꺼내서
            //     foreach($fileNameList as $index => $fileName){
                    
            //         // 파일이름이 뉴나 논이 아니면
            //         if($fileName != 'new' || $fileName != 'none' ){
                        
            //             $fileNameIndex = intval(substr($fileName, -5, 1));
            //             // 파일명의 인덱스가 순서보다 크면
            //             if($fileNameIndex > $index+1){
            //                 // 디비에서 찾아서 이름을 변경하고
            //                 $imageNewName = 'store_Img_'.$storeId.'-'.($index+1).'.png';
            //                 if(Image::where('path', '/storage/images/'.$imageNewName)->exists()){
            //                     $test = Image::where('path', '/storage/images/'.$imageNewName)->first();
            //                     $test->delete();
            //                     Storage::disk('images')->delete($imageNewName);


            //                 }
            //                 elseif(Image::where('path', '/images/'.$imageNewName)->exists()){
            //                     $test = Image::where('path', '/images/'.$imageNewName)->first();
            //                     $test->delete();
            //                     File::delete(public_path($imageNewName));
            //                 }
            //             }

            //         }




            //     }

            // }


            // $remainFileCount = 0;


            

            // foreach($fileNameList as $index => $fileName){

            //     if($fileName == 'new' || $fileName == 'none' ){

            //         $imageNewName = 'store_Img_'.$storeId.'-'.($index+1).'.png';
            //         if(Image::where('path', '/storage/images/'.$imageNewName)->exists()){
            //             $test = Image::where('path', '/storage/images/'.$imageNewName)->first();
            //             $test->delete();
            //             Storage::disk('images')->delete($imageNewName);
            //         }
                    
            //         elseif(Image::where('path', '/images/'.$imageNewName)->exists()){
            //             $test = Image::where('path', '/images/'.$imageNewName)->first();
            //             $test->delete();
            //             File::delete(public_path($imageNewName));
            //         }


            //     }

            //     else{
            //         $fileNameIndex = intval(substr($fileName, -5, 1));
                    
            //         // 파일의 위치가 변경되었으면 시작
            //         if($fileNameIndex > $index+1){

            //             // 덮어쓸파일의 폴더 위치 에따라 파일 설정
            //             if(File::exists(public_path('images/'.$fileName))){
            //                 $overwriteFile = public_path('images/'.$fileName);
            //                 $imagedb_query = Image::where('path', '/images/'.substr($fileName, 0, -5).($index+1).'.png')->first();
            //                 $imagedb_query->delete();
            //                 Image::insert(['store_id' => $storeId ,'path' => '/storage/images/'.substr($fileName, 0, -5).($index+1).'.png']);
            //             }
            //             else{
            //                 $overwriteFile = public_path('storage/images/'.$fileName);
            //                 $imagedb_query = Image::where('path', '/storage/images/'.substr($fileName, 0, -5).($index+1).'.png')->first();
            //                 $imagedb_query->delete();
            //                 Image::insert(['store_id' => $storeId ,'path' => '/storage/images/'.substr($fileName, 0, -5).($index+1).'.png']);
            //             }
            //             // 지울 파일의 위치
            //             $deletingFile = public_path('images/'.substr($fileName, 0, -5).($index+1).'.png');
                        
            //             //지울파일의 위치에 따라 파일삭제하고 덮어쓰기
            //             if(File::exists($deletingFile)){
            //                 copy($overwriteFile, public_path('storage/images/'.substr($fileName, 0, -5).($index+1).'.png'));
            //                 File::delete($deletingFile);
            //                 File::delete($overwriteFile);
            //                 // $previous_path = '/images/';
            //             }
                        
            //             else{
            //                 if(File::exists(public_path('images/'.$fileName))){
            //                     copy($overwriteFile, public_path('storage/images/'.substr($fileName, 0, -5).($index+1).'.png'));
            //                 }
            //                 else{
            //                     Storage::disk('images')->delete(substr($fileName, 0, -5).($index+1).'.png');
            //                     Storage::disk('images')->move($fileName, substr($fileName, 0, -5).($index+1).'.png');
            //                 }
            //                 // $previous_path = '/storage/images/';
            //             }

            //         }
            //         // 파일 개수 확인 
            //         $remainFileCount = $remainFileCount + 1;
            //     }
            // }
        
            // // 나머지 파일 삭제하여 초기화하기
            // // 기존파일의 개수확인
            // $maxFileCount = 0;
            // foreach($imageNames as $imageName){
            //     if($imageName != ""){
            //         $maxFileCount = $maxFileCount + 1;
            //     }
            // }
            
            // for($i=$remainFileCount+1;$i<=$maxFileCount;$i++){
            //     $tempFileName = substr($fileNameList[0], 0, -5).($i).'.png';
            //     // dd($tempFileName);
            //     if(File::exists(public_path('images/'.$tempFileName))) {
            //         File::delete(public_path('images/'.$tempFileName));
            //         $previouspath = '/images/';
            //         if(Image::where('path', $previouspath.$tempFileName)->exists()){
            //             $previousImage = Image::where('path', $previouspath.$tempFileName)->first();
            //             $previousImage->delete();
            //         }
            //     }
            //     else{
            //         Storage::disk('images')->delete($tempFileName);
            //         $previouspath = '/storage/images/';
            //         if(Image::where('path', $previouspath.$tempFileName)->exists()){
            //             $previousImage = Image::where('path', $previouspath.$tempFileName)->first();
            //             $previousImage->delete();
            //         }
            //     }
            // }


            // // 이미지 삭제 및 등록
            // $input = $request->all();

            // if($deleteFileList[0] != ""){
            //     // 수정할 이미지 삭제
            //     foreach($deleteFileList as $deleteFileIndex){
            //         $deleteFileIndex = intval($deleteFileIndex) -1;
            //         if($imageNames[$deleteFileIndex] != ''){

                        
            //             // 삭제 - public에 파일이 있으면
            //             $publicpathfile = public_path('images/'.($imageNames[$deleteFileIndex]));
            //             if(File::exists($publicpathfile) == true){
            //                 File::delete($publicpathfile);
            //                 $previous_path = '/images/';
            //             }
            //             // 삭제 - Storage에 파일이 있으면
            //             else{
            //                 Storage::disk('images')->delete(basename($imageNames[$deleteFileIndex]));
            //                 $previous_path = '/storage/images/';
            //             }
            //             $previousImage = Image::where('path', $previous_path.$imageNames[$deleteFileIndex])->first();
            //             $previousImage->delete();
            //             $imageNames[$deleteFileIndex] = 'deleted';
            //         }
            //     }

            //     // 기존파일명 수정
            //     if($changedFileList[0] != ""){
            //         for($i=0;$i<5;$i++){
            //             if($imageNames[$i] == 'deleted' ){
            //                 $firstIndex = $i;
            //                 break;
            //             }
            //         }
                    
            //         foreach($changedFileList as $tempIndex){
            //             // dd($tempIndex);
            //             $changedFileIndex = intval($tempIndex) -1;
            //             Image::where('path', $previous_path.basename($imageNames[$changedFileIndex]))->update(['path' => '/storage/images/'.substr($imageNames[$changedFileIndex], 0, -5).($firstIndex+1).'.png']);
            //             $publicpathfile = public_path('images/'.($imageNames[$changedFileIndex]));
            //             if(File::exists($publicpathfile) == true){
            //                 copy($publicpathfile, public_path('storage/images/'.substr(basename($imageNames[$changedFileIndex]), 0, -5).($firstIndex+1).'.png'));
            //                 File::delete($publicpathfile);
            //             }
            //             else{
            //             Storage::disk('images')->move(basename($imageNames[$changedFileIndex]), substr(basename($imageNames[$changedFileIndex]), 0, -5).($firstIndex+1).'.png');
            //             }
            //             $firstIndex = $firstIndex + 1;
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

        // dd(Review::where('store_id', $request->id)->exists());
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
