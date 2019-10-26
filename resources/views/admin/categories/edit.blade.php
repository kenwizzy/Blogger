@extends('layouts.admin')


@section('content')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Categories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Category</li>
            </ol> 
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

<div class="container">
<section class="content">
        <div class="col-12">
            <div class="row">
            <div class="col-sm-6">
                
            <div class="card">
            <div class="card-header">
              <h3 class="card-title"> Update Category</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            
            {!! Form::model($category, ['method'=>'PATCH', 'action'=>['AdminCategoriesController@update', $category->id]]) !!}
                <div class="form-group">
                  {!! Form::text('name', null, ['class'=>'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::submit('Update', ['class'=>'btn btn-primary']) !!}
                </div>
                
            {!! Form::close() !!} 
                
            </div>
        </div>
            </div>
            
          <!-- /.card -->
            
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
</div>

@stop