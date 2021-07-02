<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Pdf;
use App\Photo;
use App\Link;
use File;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class FrontController extends Controller
{
    public function index(){
        return view('front.index');
    }

    public function showLoginForm()
    {
        return view('front.login');
    }

    public function registration(){
        return view('front.registration');
    }

    public function image_store(Request $request){
        if(Auth::check() ){
            $file1= new Photo();
            $file1->user_id= Auth::user()->id;;

            if ($request->hasFile('imageFile')){
                $uploadedImage = $request->file('imageFile');
                $imageName = time() . '.' . $uploadedImage->getClientOriginalExtension();
                $uploadedImage->move('public/upload/', $imageName);
                $file1->image = 'public/upload/' . $imageName;
            }
                
            $file1->save(); 
            // dd('ok');
            $linkId = $file1->id;
            $link =asset('download/link/web/single/image/'.$linkId);
            // dd($link);
            $main = QrCode::size(150)

                    ->format('svg')

                    ->generate($link, public_path('images/qrcode.svg'));

                    $time = time();


            File::copy(public_path('images/qrcode.svg'),public_path('upload/'.$time.'.svg'));

            $imageLocation ='public/upload/'.$time.'.svg';

            $result_av_Gift = Photo::where('id',$linkId)->update(['qr_image'=>$imageLocation]);

            Toastr::success('Successully Added :)' ,'Success');
            return redirect()->route('index');
        } else{
            Toastr::info('Login First ' ,'Info');
			return redirect()->route('user_login');
        }



    }


    
    public function link_store(Request $request){

        if(Auth::check() ){
            $link = $request->input('link');

            // dd($link);

            $main = QrCode::size(150)

                ->format('svg')

                ->generate($link, public_path('upload/qrcode.svg'));

                $time = time();

                // dd($time);

            File::copy(public_path('upload/qrcode.svg'),public_path('upload/'.$time.'.svg'));
            // dd('ok');
            $imageLocation ='public/upload/'.$time.'.svg';

            $linkCode = New Link();
            $linkCode->user_id = Auth::user()->id;
            $linkCode->link = $link;
            $linkCode->qr_image = $imageLocation; 
            $linkCode->save();
            //dd($imageLocation);
            Toastr::success('Successully Added :)' ,'Success');
            return redirect()->route('index');
        } else{

            Toastr::info('Login First ' ,'Info');
			return redirect()->route('user_login')->with('Login error', 'Login first');
		}

    }

    // PDF------------

    public function pdf_store(Request $request){
    if(Auth::check()){
        $file1= new Pdf();
        $file1->user_id= Auth::user()->id;;

        if ($request->hasFile('imageFile')){
            $uploadedImage = $request->file('imageFile');
            $imageName = time() . '.' . $uploadedImage->getClientOriginalExtension();
            $uploadedImage->move('public/upload/', $imageName);
            $file1->pdf_file = 'public/upload/' . $imageName;
        }
        //  dd($file1);
            
        $file1->save(); 
        // dd('ok');
        $linkId = $file1->id;
        $link =asset('download/link/web/single/image/'.$linkId);
        // dd($link);
        $main = QrCode::size(150)

                ->format('svg')

                ->generate($link, public_path('pdf/qrcode.svg'));

                $time = time();


        File::copy(public_path('pdf/qrcode.svg'),public_path('upload/'.$time.'.svg'));

        $imageLocation ='public/upload/'.$time.'.svg';

        $result_av_Gift = Pdf::where('id',$linkId)->update(['qr_image'=>$imageLocation]);

        Toastr::success('Successully Added :)' ,'Success');
        return redirect()->route('index');
    }else{

        Toastr::info('Login First ' ,'Info');
        return redirect()->route('user_login')->with('Login error', 'Login first');

    }


    }

   
}