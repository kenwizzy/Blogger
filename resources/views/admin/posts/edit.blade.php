@extends('layouts.admin')

@section('content')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Posts</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Post</li>
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
              <h3 class="card-title">Edit Post</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <!--Note: Always ensure the name attribute of the text fields is the same as the table properties-->
            {!! Form::model($post, ['method'=>'PATCH', 'action'=>['AdminPostsController@update', $post->id], 'files'=>true]) !!}
                
                <div class="col-sm-3" style='margin:auto;'>
                
                <img width="200" class="img-rounded" src="../../../{{$post->photo?$post->photo->file:'images/user-icon-6.jpg'}}" alt="">

                </div>
                    <div class='form-group'>
                    {!! Form::label('title', 'Title:') !!}
                    {!! Form::text('title', null, ['class'=>'form-control']) !!}
                    </div>
                    <div class='form-group'>
                    {!! Form::label('category_id', 'Category:') !!}
                    {!! Form::select('category_id',  $categories, null, ['class'=>'form-control']) !!}
                    </div>
                    <div class='form-group'>
                    {!! Form::label('photo_id', 'Image:') !!}
                    {!! Form::file('photo_id', ['class'=>'form-control']) !!}
                    </div>
                    
                    <div class='form-group'>
                    {!! Form::label('body', 'Content:') !!}
                    {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class='form-group'>
                    {!! Form::submit('Update Post', ['class'=>'btn btn-primary']) !!}
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