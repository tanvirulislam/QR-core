@extends('admin.master.master')

@section('title')
Image | QR CODE
@endsection


@section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>QR Code of Image</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Website and Social Link</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-2">

                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <!-- <h3 class="card-title">Website and Social Link</h3> -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>

                                    <th>Image</th>
                                    <th>QR Code(svg)</th>
                                    <th>(eps)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($links as $key=>$category)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        {{ $category->user_info->name }}
                                    </td>
                                    <td>

                                        <img src="{{asset('/')}}{{$category->image}}" width="70px" height="70px">
                                        <br><br>
                                    </td>
                                    <td>

                                        <img src="{{asset('/')}}{{$category->qr_image}}" width="70px" height="70px">
                                        <br><br>
                                        <a href="{{route('admin.download_image',$category->id)}}"
                                            class="btn bg-olive">Download</a>
                                    </td>
                                    <td>
                                        <!--<img src="{!!$category->qr_image_png!!}>-->
                                        <img src="{{asset('/')}}{{$category->qr_image_eps}}" width="70px" height="70px">
                                        <br><br>
                                        <a href="{{route('admin.download_image_eps',$category->id)}}"
                                            class="btn bg-olive">Download</a>
                                    </td>

                                    <td><button type="button" class="btn btn-danger text-light"
                                            onclick="deleteTag({{ $category->id }})"><i
                                                class="fas fa-trash-alt"></i></button>
                                        <form id="delete-form-{{ $category->id }}"
                                            action="{{ route('admin.image.destroy',$category->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf

                                        </form>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>QR Code(svg)</th>
                                    <th>(eps)</th>
                                    <th>Action</th>

                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
function deleteTag(id) {
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            event.preventDefault();
            document.getElementById('delete-form-' + id).submit();
        } else if (
            // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
        ) {
            swal(
                'Cancelled',
                'Your data is safe :)',
                'error'
            )
        }
    })
}
</script>
@endsection