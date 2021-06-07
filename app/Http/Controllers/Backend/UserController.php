<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    public function addUser(){
//        dd('ok');
        return view('back-end.user.add-user');
    }
    public function saveUser(Request $request){
        $this->validate($request,[
           'name' => 'required',
           'email'=> 'required|unique:users,email',
           'role' => 'required',
           'password'=>'required'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->save();
        return redirect('users/view')->with('message','User Information has been added successfully!!!');
    }
    public function viewUser(){
    	$users = User::all();
//    	return $users;
        return view('back-end.user.view-user',['users'=>$users]);
    }
    public function editUser($id){
        $editUser = User::find($id);
//        return $editUser;
        return view('back-end.user.edit-user',['editUser'=>$editUser]);
    }
    public function updateUser(Request $request){
        $user = User::find($request->user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        $user->update();
        return redirect('users/view')->with('message','User Information has been updated successfully!!!!');
    }
    public function deleteUser($id) {
        $user = User::find($id);
        if(file_exists('public/upload/user-images/' .$user->image) AND !empty($user->image)){
            unlink('public/upload/user-images/' .$user->image);
        }
        $user->delete();
//        return redirect('users/view')->with('message','User Information has been deleted successfully!!!');
        return redirect()->route('view-user')->with('message','User Information deleted successfully!!!');
    }

}

