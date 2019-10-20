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
              <li class="breadcrumb-item active">Create users</li>
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
              <h3 class="card-title">Create User</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
  
            {!! Form::open(['method'=>'POST', 'action'=>'AdminUsersController@store','files'=>'true']) !!}

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
                    {!! Form::select('role_id',[''=>'Select Roles'] + $roles, null, ['class'=>'form-control']) !!}
                    </div>
                    <div class='form-group'>
                    {!! Form::label('is_active', 'Status:') !!}
                    <!-- Replacing the null with 0 key automaticall set the dfault to not active -->
                    {!! Form::select('is_active', array(1=>'Active', 0=>'Not Active'), 0, ['class'=>'form-control']) !!}
                    </div>
                    <div class='form-group'>
                    {!! Form::label('file', 'Image:') !!}
                    {!! Form::file('file', ['class'=>'form-control']) !!}
                    </div>
                    <div class='form-group'>
                    {!! Form::label('password', 'Password:') !!}
                    {!! Form::password('password', ['class'=>'form-control']) !!}
                    </div>

                    <div class='form-group'>
                    {!! Form::submit('Create User', ['class'=>'btn btn-primary']) !!}
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