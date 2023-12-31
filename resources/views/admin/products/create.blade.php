@extends('admin.layouts.master')
@section('title' , 'Add Product')
    

@section('css')
<link href="{{asset('admin/assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>
@endsection



@section('content')
<div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
    <form method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-body">

          @if ($errors->any())
          <div class="alert alert-outline-danger mg-b-0" role="alert">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span></button>
            <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            </ul>
          </div>
          @endif
        
          @if(session()->has('success'))

          <div class="alert alert-outline-success" role="alert">
              <button aria-label="Close" class="close" data-dismiss="alert" type="button">
              <span aria-hidden="true">&times;</span></button>
              {{session()->get('success')}}
          </div>
  
         @endif
            {{-- <div class="main-content-label mg-b-5">
                Add Category
            </div> --}}
            <br>
            <p class="mg-b-20">Add Product</p>
            <div class="row row-sm">
                <div class="col-lg">
                    <label >Product Name</label>
                    <input class="form-control mg-b-20" name="name" placeholder="product name" placeholder="Input box" type="text">
                    <label >Description</label>
                        <textarea class="form-control" name="description" placeholder="description" placeholder="Textarea" rows="3"></textarea>
                        <br>
                        <label >Price</label>
                    <input class="form-control mg-b-20" name="price" placeholder="price" placeholder="Input box" type="number">
                        <label >Old Price</label>
                    <input class="form-control mg-b-20" name="old_price" placeholder="old price" placeholder="Input box" type="number">
                </div>
            </div>

            <div class="mb-4">
                <p class="mg-b-10">Categories</p>
                <select name="category_id" class="form-control SlectBox" onclick="console.log($(this).val())" onchange="console.log('change is firing')">
                    <!--placeholder-->
                    <option value="{{null}}">Select Category</option>
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            
            
            <div>
                <label >Main Image</label>
                <div class="row mb-4">
                    <div class="col-sm-12 col-md-4">
                        <input type="file" name="image" class="dropify" data-height="200" />
                    </div>
                </div>
            </div>
                            
            <div>
                <label >Multi Images</label>
                <div class="custom-file">
                    <input class="custom-file-input" type="file" id="upload_file" name="images[]" onchange="preview_image();" multiple/>
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            <br>
            <div id="image_preview" style="height: 6%; width:6%; display:flex;"></div>
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

<script>
     $(document).ready(function() 
{ 
 $('form').ajaxForm(function() 
 {
  alert("Uploaded SuccessFully");
 }); 
});

function preview_image() 
{
 var total_file=document.getElementById("upload_file").files.length;
 for(var i=0;i<total_file;i++)
 {
  $('#image_preview').append("<img style='margin-right: 20px;' src='"+URL.createObjectURL(event.target.files[i])+"'><br>");
 }
}
</script>

@endsection