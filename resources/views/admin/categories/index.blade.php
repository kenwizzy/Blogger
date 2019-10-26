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
              <li class="breadcrumb-item active">Categories</li>
            </ol> 
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

<div class="container">
<section class="content">
        <div class="col-12">
            
             @if(Session::has('delete_cat')) 
                
                <div class='alert alert-success'>
                   <p class='text-center'>{{session('delete_cat')}}</p>
               </div>
                
                @endif
                
                @if(Session::has('update_cat')) 
                
                <div class='alert alert-success'>
                   <p class='text-center'>{{session('update_cat')}}</p>
               </div>
                
                @endif
                
                @if(Session::has('create_cat')) 
                
                <div class='alert alert-success'>
                   <p class='text-center'>{{session('create_cat')}}</p>
               </div>
                
                @endif
            
            <div class="row">
            <div class="col-sm-6">  
            <div class="card">
            <div class="card-header">
              <h3 class="card-title"> Create Categories</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            
            {!! Form::open(['method'=>'POST', 'action'=>['AdminCategoriesController@store']]) !!}
                <div class="form-group">
                  {!! Form::text('name', null, ['class'=>'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
                </div>
                
            {!! Form::close() !!} 
            
            
            </div>
        </div>
            </div>
            
            <div class="col-sm-6">
            
                
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">All Categories</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                               
              <table id="example2" class="table table-bordered table-hover">
                @if($categories)
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    
                  @foreach($categories as $category)
                <tr>
                  <td>{{$category->id}}</td>
                    <td><a href="{{route('admin.categories.edit', $category->id)}}">{{$category->name}}</a></td>
                  <td>{{$category->created_at? $category->created_at->diffForHumans(): 'No Date'}}</td>
                  <td>{{$category->updated_at? $category->updated_at->diffForHumans(): 'No Date'}}</td>
                  <td>
                    
                  {!! Form::open(['method'=>'DELETE', 'action'=>['AdminCategoriesController@destroy', $category->id]]) !!}
                
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
            
            
            </div>
            
          
          <!-- /.card -->
            
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
</div>

@stop