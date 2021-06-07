<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;

class ProfileController extends Controller
{
    public function viewProfile(){
        $id = Auth::User()->id;
        //        dd($id);
        $user = User::find($id);
//        dd($user);
        return view('back-end.profile.view-profile',['user'=>$user]);
    }
    public function editProfile($id){
        $id = Auth::User()->id;
        $editUser = User::find($id);
        return view('back-end.profile.edit-profile',['editUser'=>$editUser]);
    }
    public function updateProfile(Request $request){
        $user = User::find(Auth::User()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->mobile = $request->mobile;
        if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('upload/user-images/'.$user->image));
            $fileName = date('YmHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user-images/'), $fileName);
            $user['image']=$fileName;
        }
        $user->update();
        return redirect('profiles/view')->with('message','Profile updated successfully');
    }
    public function changePassword(){
        $user = User::find(Auth::User()->id);
        return view('back-end.profile.edit-password',['user'=>$user]);
    }
    public function updatePassword(Request $request){
        $this->validate($request,[
            'old_password'=>'required',
            'new_password'=>'required',
            'confirm_password'=>'required'
        ]);
        if(Auth::attempt(['id'=>Auth::User()->id,'password'=>$request->old_password])){
//            dd('OK');
            $user = User::find(Auth::User()->id);
            $user->password = bcrypt($request->new_password);
            $user->update();
            return redirect('profiles/view')->with('message','Password has been changed successfully!!!!');
        }else{
//            dd('error');
            return redirect()->back()->with('message','your current password does not match!!');
        }
    }

}
