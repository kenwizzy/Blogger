<?php

namespace App\Http\Controllers;
use App\Photo;
use Illuminate\Support\Facades\Auth;//imported Auth class
use App\User;
use App\Category;
use App\Post;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\PostsCreateRequest;
use Illuminate\Http\Request;
use App\Http\Requests;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::lists('name','id')->all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {

       // return $request->all();
       //get all request and assign to a variable
       $input = $request->all();

       //gets the logged in user
       $user = Auth::user();

       //checks if the request has a file ie image
       if($file = $request->file('photo_id')){

        //get the name of the file and append the time to it
         $name = time() . $file->getClientOriginalName();

         //move the file to images folder
         $file->move('images', $name);

         //insert the image name property to image table using the create method and assign the object to photo variable
         $photo = Photo::create(['file'=>$name]);

         //pull out the photo id property from the photo object and insert into the request array
         $input['photo_id'] = $photo->id;
       }
        
       //submits the post to the post table with the logged in user's relationship
       $user->posts()->create($input);
       Session::flash('post_created', 'The post has been created successfully');
       return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::lists('name','id')->all();
        return view('admin.posts.edit', compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
          }

        Auth::user()->posts()->whereId($id)->first()->update($input);
        Session::flash('post_updated', 'The post '.$input['title'].' has been updated successfully');
        return redirect('admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        //this targets the post's image and delete it as well from the server
        unlink(public_path() . '/'.$post->photo->file); 
        $post->delete();
        
        //save the message in a session
        Session::flash('deleted_post', 'The post '.$post->title.' has been deleted successfully');
        return redirect('admin/posts');
    }
}
