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
use DOMPDF;

class FrontController extends Controller
{
    public function index(){
        return view('front.index2');
    }

    public function showLoginForm()
    {
        return view('front.login');
    }

    public function registration(){
        return view('front.registration');
    }

    public function image_store(Request $request){
       
            $file1= new Photo();
            $file1->user_id= Auth::user()->id;

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
            $main = QrCode::size(200)
                    ->margin(10)
                    ->format('svg')
                    ->generate($link, public_path('images/qrcode.svg'));
                    $time = time();

            File::copy(public_path('images/qrcode.svg'),public_path('vcard/'.$time.'.svg'));

            $imageLocation ='public/vcard/'.$time.'.svg';

            $result_av_Gift = Photo::where('id',$linkId)->update(['qr_image'=>$imageLocation]);

            $main = QrCode::size(150)

                    ->format('eps')

                    ->generate($link, public_path('images/qrcode.eps'));

                    $time = time();


            File::copy(public_path('images/qrcode.eps'),public_path('vcard/'.$time.'.eps'));

            $imageLocation ='public/vcard/'.$time.'.eps';

            $result_av_Gift = Photo::where('id',$linkId)->update(['qr_image_eps'=>$imageLocation]);

            Toastr::success('Successully Added :)' ,'Success');
            return redirect()->back();
      



    }

    
    public function image($id){

        $photo = Photo::where('id',$id)->latest()->first();
        //   dd($photo);

        return view('front.web_image_view', compact('photo'));
   
   
    }


    
    public function link_store(Request $request){

      
            $link = $request->input('link');

            // dd($link);

            $main = QrCode::size(150)

                ->format('svg')

                ->generate($link, public_path('link/upload/qrcode.svg'));

                $time = time();

                // dd($time);

            File::copy(public_path('link/upload/qrcode.svg'),public_path('link/upload/'.$time.'.svg'));
            // dd('ok');
            $imageLocation ='public/link/upload/'.$time.'.svg';

            $linkCode = New Link();
            $linkCode->user_id = Auth::user()->id;
            $linkCode->link = $link;
            $linkCode->qr_image = $imageLocation; 
            $linkCode->save();
            //dd($imageLocation);
            Toastr::success('Successully Added :)' ,'Success');
            return redirect()->back();
       

    }

    // PDF------------

    public function pdf_store(Request $request){
       

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
            $link =asset('download/link/web/single/pdf/'.$linkId);
            // dd($link);
            $main = QrCode::size(150)
                    ->margin(10)
                    ->format('svg')
                    ->generate($link, public_path('pdf/qrcode.svg'));
                    $time = time();

            File::copy(public_path('pdf/qrcode.svg'),public_path('upload/'.$time.'.svg'));
            $imageLocation ='public/upload/'.$time.'.svg';
            $result_av_Gift = Pdf::where('id',$linkId)->update(['qr_image'=>$imageLocation]);
            
            $main = QrCode::size(150)
            ->margin(10)
            ->format('eps')
            ->generate($link, public_path('pdf/qrcode.eps'));
            $time = time();

            File::copy(public_path('pdf/qrcode.eps'),public_path('upload/'.$time.'.eps'));
            $imageLocation ='public/upload/'.$time.'.eps';
            $result_av_Gift = Pdf::where('id',$linkId)->update(['qr_image_eps'=>$imageLocation]);
            
            Toastr::success('Successully Added :)' ,'Success');
             return redirect()->back();


    }
    
      public function pdf($id){
           
        $menu = Pdf::where('id',$id)->first();
   
        return view('front.web_pdf_view',['menu'=>$menu]);
   
    }

    public function download($id){

        $mailfile = Pdf::where('id',$id)->value('pdf_file');

        // $file_path ='public/upload/'.$mailfile;

        return response()->download($mailfile);

    }

   
}