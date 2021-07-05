@extends('front.master.master')
@section('title')
QR Code Generator
@endsection

@section('body')
<div class="container">
    <br>
    <center><h3>Create your QR Code for free</h3></center>
    <!-- <marquee behavior="scroll" direction="left"><h3>Create your QR Code for free</h3></marquee> -->
    <hr>
    <br>
    <div class="row ">
        <div class="col-md-4">
            <div class="icon-div">
                <i class="fas fa-link custom-icon"></i>
                <p>URL</p>
            </div>
            <form method="POST" action="{{ route('link_store') }}" class="form-horizontal"
                    enctype="multipart/form-data" > 
                    @csrf
                <div class="form-group">
                <label for="formGroupExampleInput2">Website link</label>
                <input type="text" name="link" class="form-control" id="formGroupExampleInput2" placeholder="Website link"
                required>
                </div>
                <button type="submit" class="btn btn-info">Submit</button>
            </form>
        </div>
        <div class="col-md-4">
            <div class="icon-div">
                <i class="far fa-image custom-icon"></i>
                <p>Image</p>
            </div>
            
            <form method="POST" action="{{ route('image_store') }}" class="form-horizontal"
                    enctype="multipart/form-data">
                    @csrf
                <div class="form-group">
                <label for="formGroupExampleInput2">Image</label>
                <input type="file" name="imageFile" class="form-control" id="formGroupExampleInput2" 
                placeholder="Image" required>
                </div>
                <button type="submit" class="btn btn-info">Submit</button>
            </form>

        </div>
        <div class="col-md-4">
            <div class="icon-div">
                <i class="far fa-file-pdf custom-icon"></i>
                <p>PDF</p>
                
            </div>
            
            <form method="POST" action="{{ route('pdf_store') }}" class="form-horizontal"
                    enctype="multipart/form-data">
                    @csrf
                <div class="form-group">
                <label for="formGroupExampleInput2">PDF</label>
                <input type="file" name="imageFile" class="form-control" id="formGroupExampleInput2" 
                placeholder="Website link" required>
                </div>
                <button type="submit" class="btn btn-info">Submit</button>
            </form>

        </div>
    </div>

</div>
@endsection
