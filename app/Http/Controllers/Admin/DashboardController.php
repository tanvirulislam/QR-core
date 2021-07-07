<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use Brian2694\Toastr\Facades\Toastr;
use App\Photo;
use App\Pdf;
use App\Link;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use File;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
      $link =Link::count();
      $pdf =Pdf::count();
      $photo =Photo::count();
    
        return view('admin.dashboard', compact('link', 'pdf', 'photo'));
    }

    public function link(){
        
        $links = Link::all();

        return view('admin.link', compact('links'));
    }

    public function download_link($id){

        $mailfile = Link::where('id',$id)->value('qr_image');
    
        //$file_path = public_path('images/qrcode.svg');
        return response()->download($mailfile);
    
    }

    public function link_destroy($id)
    {
        Link::find($id)->delete();
        Toastr::warning('Successfully Deleted :)','Success');
        return redirect()->back();
    }

    public function image(){
        
        $links = Photo::all();
        
        return view('admin.image', compact('links'));
    }

    public function download_image($id){

        $mailfile = Photo::where('id',$id)->value('qr_image');
    
        //$file_path = public_path('images/qrcode.svg');
        return response()->download($mailfile);
    
    }

    public function download_image_eps($id){

        $mailfile = Photo::where('id',$id)->value('qr_image_eps');
    
        //$file_path = public_path('images/qrcode.svg');
        return response()->download($mailfile);
    
    }

    public function image_destroy($id)
    {
        Photo::find($id)->delete();
        Toastr::warning('Successfully Deleted :)','Success');
        return redirect()->back();
    }

    public function pdf(){
        
        $links = Pdf::all();
        
        return view('admin.pdf', compact('links'));
    }

    public function download_pdf($id){

        $mailfile = Pdf::where('id',$id)->value('qr_image');
    
        return response()->download($mailfile);
    
    }
    
    public function download_pdf_eps($id){

        $mailfile = Pdf::where('id',$id)->value('qr_image_eps');
    
        return response()->download($mailfile);
    
    }

    public function pdf_destroy($id)
    {
        Pdf::find($id)->delete();
        Toastr::warning('Successfully Deleted :)','Success');
        return redirect()->back();
    }

    // new add-------------------
    public function create_qr(){

        return view ('admin.create_qr');

    }

    public function link_store(Request $request){

      
        $link = $request->input('link');

        // dd($link);

        $main = QrCode::size(150)
            ->margin(10)
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
        Toastr::success('Successully created :)' ,'Success');
        return redirect()->back();

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

        Toastr::success('Successully created :)' ,'Success');
        return redirect()->back();

    }

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
        
        Toastr::success('Successully created :)' ,'Success');
         return redirect()->back();


    }


}
