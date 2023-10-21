@extends('admin.layouts.master')
@section('title' , 'Users')


@section('content')

<div class="col-xl-12">
    <div class="card mg-b-20">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between">
                <h4 class="card-title mg-b-0">Users</h4>
                <i class="mdi mdi-dots-horizontal text-gray"></i>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered mg-b-0 text-md-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Birth Date</th>
                            <th>Phone Number</th>
                            <th>Status</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->birth_date}}</td>
                            <td>{{$user->phone_number}}</td>
                            <td>
                                @if($user->status == 'active')
                                <div class="badge badge-success">Active</div>
                                @else
                                <div class="badge badge-danger">Not Active</div>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary"
                                    data-toggle="dropdown"  type="button">Operations<i class="fas fa-caret-down ml-1"></i></button>
                                    <div  class="dropdown-menu tx-10">
                                        @if($user->status == 'deactive')
                                        <a class="dropdown-item" href="{{route('activation' , $user->id)}}">Active</a>
                                        @else
                                        <a class="dropdown-item" href="{{route('activation' , $user->id)}}">Not Active</a>
                                        @endif
                                    </div>
                                </div>
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