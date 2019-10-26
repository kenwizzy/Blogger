
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
              <li class="breadcrumb-item active">Posts</li>
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
              <h3 class="card-title">All Posts</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
               @if(Session::has('post_created')) 
                
                <div class='alert alert-success'>
                   <p class='text-center'>{{session('post_created')}}</p>
               </div>
                
                @endif
                
                @if(Session::has('deleted_post')) 
                
                <div class='alert alert-success'>
                   <p class='text-center'>{{session('deleted_post')}}</p>
               </div>
                
                @endif
                
                @if(Session::has('post_updated')) 
                
                <div class='alert alert-success'>
                   <p class='text-center'>{{session('post_updated')}}</p>
               </div>
                
                @endif
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Title</th>
                  <th>Owner</th>
                  <th>Category</th>
                  <th>Image</th>
                  <th>Content</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
     @if($posts)
        @foreach($posts as $post)
                <tr>
                  <td>{{$post->id}}</td>
                    <td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->title}}</a></td>
                  <td>{{$post->user? $post->user->name: 'User Deleted'}}</td>
                  <td>{{$post->category? $post->category->name:'Uncategorised'}}</td>
                  <td><img width='70' src="../{{$post->photo? $post->photo->file : 'images/user-icon-6.jpg'}}" alt=""></td>
                  <td>{{str_limit($post->body, 20)}}</td>
                  <td>{{$post->created_at->diffForHumans()}}</td>
                  <td>{{$post->updated_at->diffForHumans()}}</td>
                  <td> 
                     {!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy', $post->id]]) !!}
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
