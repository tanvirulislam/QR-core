<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
// use PDF;
use Brian2694\Toastr\Facades\Toastr;
use App\Photo;
use App\Pdf;
use App\Link;

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

    public function pdf_destroy($id)
    {
        Pdf::find($id)->delete();
        Toastr::warning('Successfully Deleted :)','Success');
        return redirect()->back();
    }

}
