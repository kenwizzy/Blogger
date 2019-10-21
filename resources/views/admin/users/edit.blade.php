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
              <li class="breadcrumb-item active">Edit users</li>
            </ol> 
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

 <div class="container">
    <section class="content">
      
        <div class="col-md-8" style='margin:auto;'>

        @include('includes.form_errors')

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Edit User</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <!--Note: Always ensure the name attribute of the text fields is the same as the table properties-->
            {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id],'files'=>'true']) !!}
                
                <div class="col-sm-3" style='margin:auto;'>
                
                <img width="200" class="img-rounded" src="../../../{{$user->photo?$user->photo->file:'images/user-icon-6.jpg'}}" alt="">

                </div>
                    
                    <div class='form-group'>
                    {!! Form::label('name', 'Name:') !!}
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                    </div>
                    <div class='form-group'>
                    {!! Form::label('email', 'Email:') !!}
                    {!! Form::email('email', null, ['class'=>'form-control']) !!}
                    </div>
                    <div class='form-group'>
                    {!! Form::label('role_id', 'Role:') !!}
                    {!! Form::select('role_id', $roles, null, ['class'=>'form-control']) !!}
                    </div>
                    <div class='form-group'>
                    {!! Form::label('is_active', 'Status:') !!}
                    <!-- Replacing the null with 0 key automaticall set the dfault to not active -->
                    {!! Form::select('is_active', array(1=>'Active', 0=>'Not Active'), null, ['class'=>'form-control']) !!}
                    </div>
                    <div class='form-group'>
                    {!! Form::label('photo_id', 'Image:') !!}<br>
                    {!! Form::file('photo_id', ['class'=>'form-control']) !!}
                    </div>

                    <div class='form-group'>
                    {!! Form::label('password', 'Password:') !!}
                    {!! Form::password('password', ['class'=>'form-control']) !!}
                    </div>

                    <div class='form-group'>
                    {!! Form::submit('Update User', ['class'=>'btn btn-primary col-sm-4']) !!}
                    </div>

                   {!! Form::close() !!}
                    
           
            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy', $user->id], 'class'=>'pull-right']) !!}
                
                <div class='form-group'>
                    {!! Form::submit('Delete User', ['class'=>'btn btn-danger col-sm-4']) !!}
                </div>
                
            {!! Form::close() !!}
                    
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <!-- /.card -->
        </div>
        <!-- /.col -->

      <!-- /.row -->
    </section>
</div>

@stop