@extends('admin.layouts.master')
@section('title' , 'Add Category')
    

@section('css')
<link href="{{asset('admin/assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
@endsection



@section('content')
<div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
    <form method="POST" action="{{route('categories.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-body">

            @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
        
        @if(session()->has('success'))

        <div class="alert alert-success">

        <button type="button" class="close" data-dismiss="alert">x</button>

        {{session()->get('success')}}

        </div>
        @endif
            {{-- <div class="main-content-label mg-b-5">
                Add Category
            </div> --}}
            <p class="mg-b-20">Add Category</p>
            <div class="row row-sm">
                <div class="col-lg">
                    <label >Category Name</label>
                    <input class="form-control mg-b-20" name="name" placeholder="category name" placeholder="Input box" type="text">
                    <label >Description</label>
                        <textarea class="form-control" name="description" placeholder="description" placeholder="Textarea" rows="3"></textarea>
                </div>
                
            </div>
            <br>
            <div>
                <label >Image</label>
                <div class="row mb-4">
                    <div class="col-sm-12 col-md-4">
                        <input type="file" name="image" class="dropify" data-height="200" />
                    </div>
                </div>
            </div>
            <br>      
                            
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('dashboard')}}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </div>
</div>
</form>

@endsection


@section('js')
<script src="{{asset('admin/assets/plugins/fileuploads/js/fileupload.js')}}"></script>
<script src="{{asset('admin/assets/plugins/fileuploads/js/file-upload.js')}}"></script>
@endsection