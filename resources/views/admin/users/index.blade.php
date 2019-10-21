
@extends('layouts.admin')

@section('content')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">users</li>
            </ol> 
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

<div class="container">
<section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">All Users</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
               @if(Session::has('deleted_user')) 
                
                <div class='alert alert-success'>
                   <p class='text-center'>{{session('deleted_user')}}</p>
               </div>
                
                @endif
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Photo</th>
                  <th>Role</th>
                  <th>Active</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    
               @if($users)
        @foreach($users as $user)
                <tr>
                  <td>{{$user->id}}</td>
                    <td><a href="{{route('admin.users.edit', $user->id)}}">{{$user->name}}</a></td>
                  <td>{{$user->email}}</td>
                  <td><img width="60" src="../{{$user->photo?$user->photo->file:'images/user-icon-6.jpg'}}" alt=""></td>
                  <td>{{$user->role->name}}</td>
    <!--if the user's is_admin property is equal to 1 echo active else echo not active-->
                  <td>{{$user->is_active == 1? "Active" : "Not Active"}}</td>
                  <td>{{$user->created_at->diffForHumans()}}</td>
                  <td>{{$user->updated_at->diffForHumans()}}</td>
                  <td>
                    
                  {!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy', $user->id]]) !!}
                
                <div class='form-group'>
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                </div>
                
            {!! Form::close() !!}  
                    
                  </td>
                </tr>
        @endforeach

    @endif
     
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
</div>
@stop
