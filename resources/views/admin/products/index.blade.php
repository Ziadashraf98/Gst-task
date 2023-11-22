@extends('admin.layouts.master')
@section('title' , 'Products')

@section('css')
<style>
.pos-1{
    position: relative;
}
    
.pos-2{
    position: absolute;
    top: 0;
    left: 5px;
    
    font-size: 17px;
    font-weight: bold;
    color: black;
}
</style>
@endsection


@section('content')

<div class="col-xl-12">
    <div class="card mg-b-20">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between">
                <h4 class="card-title mg-b-0">Products</h4>
                <i class="mdi mdi-dots-horizontal text-gray"></i>
            </div>
        </div>
        <div class="card-body">
            @if(session()->has('success'))

        <div class="alert alert-outline-success" role="alert">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span></button>
            {{session()->get('success')}}
        </div>

    @endif
            <div class="table-responsive">
                <table class="table table-bordered mg-b-0 text-md-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Old Price</th>
                            <th>Category</th>
                            <th>Main Image</th>
                            <th>Multi Images</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <th scope="row">{{$product->id}}</th>
                            <td>{{$product->name}}</td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->old_price}}</td>
                            <td>{{$product->category?->name}}</td>
                            <td>
                                <img alt="Responsive image" class="rounded float-sm-left wd-100p wd-sm-200" src="{{$product->image}}">
                            </td>
                            <td>
                                @foreach($product->images as $productImages)
                                <div class="pos-1 rounded float-sm-left wd-100p wd-sm-200" style="margin-right: 20px;">
                                    <img alt="Responsive image" src="{{$productImages->image}}">
                                    <a data-target="#modaldemo5{{$productImages->id}}" data-toggle="modal"
                                    class="pos-2" href="#" data-id={{$productImages->id}}><svg xmlns="http://www.w3.org/2000/svg" height="1.25em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#9fa0a3}</style><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></a>
                                </div>

                                <div class="modal" id="modaldemo5{{$productImages->id}}">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content tx-size-sm">
                                            <div class="modal-body tx-center pd-y-20 pd-x-20">
                                                
                                
                                            <form action="{{route('delete_image' , $productImages->id)}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                {{-- <input type="hidden" name="id" value="{{$productImages->id}}"> --}}
                                                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button> <i class="icon icon ion-ios-close-circle-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                                                <h4 class="tx-danger mg-b-20">Are You Sure To Delete This ?</h4>
                                                {{-- <p class="mg-b-20 mg-x-20">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.</p> --}}
                                                <button class="btn ripple btn-danger pd-x-25" type="submit">Delete</button>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection