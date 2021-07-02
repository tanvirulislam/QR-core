<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

        $file1= new Photodetail();
        $file1->photo_id= Auth::user()->id;;

        if ($request->hasFile('imageFile')){
            $uploadedImage = $request->file('imageFile');
            $imageName = time() . '.' . $uploadedImage->getClientOriginalExtension();
            $uploadedImage->move('public/upload/', $imageName);
            $file1->photo = 'public/upload/' . $imageName;
        }
            
        $file1->save(); 
        // dd('ok');
        $linkId = $file1->id;
        $link =asset('download/link/web/single/image/'.$linkId);
        //dd($link);
        $main = QrCode::size(150)

                ->format('svg')

                ->generate($link, public_path('images/qrcode.svg'));

                $time = time();


        File::copy(public_path('images/qrcode.svg'),public_path('vcard/'.$time.'.svg'));

        $imageLocation ='public/vcard/'.$time.'.svg';

        $result_av_Gift = Photodetail::where('id',$linkId)->update(['qr_image'=>$imageLocation]);

        Toastr::success('Successully Added :)' ,'Success');
        return redirect()->route('index');



    }


    
    public function link_store(Request $request){

        $link = $request->input('link');

        //dd($link);

        $main = QrCode::size(150)

            ->format('svg')

            ->generate($link, public_path('images/qrcode.svg'));

            $time = time();

            //dd($time);


        File::copy(public_path('images/qrcode.svg'),public_path('link/'.$time.'.svg'));

        $imageLocation ='public/link/'.$time.'.svg';

        $linkCode = New QrCodeStore();
        $linkCode->user_id = Auth::user()->id;
        $linkCode->link = $link;
        $linkCode->category='link';
        $linkCode->image = $imageLocation; 
        $linkCode->save();
        //dd($imageLocation);
        Toastr::success('Successully Added :)' ,'Success');
        return redirect()->route('index');

    }

    // PDF------------

    public function pdf_store(Request $request){

        $file1= new AllFile();
        $file1->user_id= Auth::user()->id;;

        if ($request->hasFile('imageFile')){
            $uploadedImage = $request->file('imageFile');
            $imageName = time() . '.' . $uploadedImage->getClientOriginalExtension();
            $uploadedImage->move('public/upload/', $imageName);
            $file1->image = 'public/upload/' . $imageName;
        }
        //  dd($file1);
            
        $file1->save(); 
        // dd('ok');
        $linkId = $file1->id;
        $link =asset('download/link/web/single/image/'.$linkId);
        // dd($link);
        $main = QrCode::size(150)

                ->format('svg')

                ->generate($link, public_path('images/qrcode.svg'));

                $time = time();


        File::copy(public_path('images/qrcode.svg'),public_path('vcard/'.$time.'.svg'));

        $imageLocation ='public/vcard/'.$time.'.svg';

        $result_av_Gift = AllFile::where('id',$linkId)->update(['qr_image'=>$imageLocation]);

        Toastr::success('Successully Added :)' ,'Success');
        return redirect()->route('index');


    }

   
}
