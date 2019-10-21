<?php
namespace App\Http\Controllers;
use App\User;
use App\Photo;
use App\Role; 
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;
use Illuminate\Support\Facades\Session;
class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::lists('name','id')->all();//the all method (all()) need to be added because we're getting all ie the object
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //check if the password field is empty. trim out white spaces
        if(trim($request->password) == ''){
            
            //if password field is empty, allow it to submit except password
           $input = $request->except('password'); 
        }else{
            
            //if not empty allow all
            $input = $request->all();
            
            //encrypt the request password and add to the request array
        $input['password'] = bcrypt($request->password);
        }
        
        //Check if the request image (i.e form selected image ) exists
        if($file = $request->file('photo_id')){
            
            //pull out the name of the image and append time to it
            $name = time() . $file->getClientOriginalName();
            
            //move the image to images folder. If the folder doesn't exist, it creates it
            $file->move('images', $name);
            
            //insert the image into the photos table using the create method and assign it to a photo variable
            $photo = Photo::create(['file'=>$name]);
            
            //pull out the id of the image and add to the request array
            $input['photo_id'] = $photo->id;
        }
        
        //encrypt the request password and add to the request array
        //$input['password'] = bcrypt($request->password);
        
        //insert the request array to the users table
        User::create($input);
        
        return redirect('admin/users');
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
        $roles = Role::lists('name','id')->all();
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        //find the user by id
        $user = User::findOrFail($id);
        
        //check if the password field is empty. trim out white spaces
        if(trim($request->password) == ''){
            
            //if password field is empty, allow it to submit except password
           $input = $request->except('password'); 
        }else{
            
            //if not empty allow all
            $input = $request->all();
            
            //encrypt the request password and add to the request array
        $input['password'] = bcrypt($request->password);
        }

        //request all from form
        //$input = $request->all();
        
        //Check if the request image (i.e form selected image ) exists
        if($file = $request->file('photo_id')){
            
            //pull out the name of the image and append time to it
            $name = time() . $file->getClientOriginalName();
            
            //move the image to images folder. If the folder doesn't exist, it creates it
            $file->move('images', $name);
            
            //insert the image into the photos table using the create method and assign it to a photo variable
            $photo = Photo::create(['file'=>$name]);
            
            //pull out the id of the image and add to the request array
            $input['photo_id'] = $photo->id;
        }
        
        //$input['password'] = bcrypt($request->password);
        
        //update the request(the selected user id) array in the users table
        $user->update($input);
        
        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        //this targets the user's image and delete it as well from the server
        unlink(public_path() . '/'.$user->photo->file); 
        $user->delete();
        
        //save the message in a session
        Session::flash('deleted_user', 'The user has been deleted successfully');
        return redirect('admin/users');
    }
}
