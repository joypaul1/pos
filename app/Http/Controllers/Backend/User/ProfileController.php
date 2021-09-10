<?php

namespace App\Http\Controllers\Backend\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\User;

class ProfileController extends Controller
{
    public function adminProfile(){
        $user = User::where('id',Auth::user()->id)->first();
        return view('backend.profile.user-profile-view', compact('user'));
    }

    public function adminProfileEdit($id){
        $editData = User::find($id);
        return view('backend.profile.user-profile-edit', compact('editData'));
    }

    public function adminProfileUpdate(UserRequest $request ,$id){
        $users = User::find($id);
        $img = $request->file('image');
        if ($img) {
            $imgName = md5(str_random(30) . time() . '_' . $img) . '.' . $img->getClientOriginalExtension();
            $request->file('image')->move('public/backend/user_images/', $imgName);
            if (file_exists('public/backend/user_images/' . $users->image) AND ! empty($users->image)) {
                unlink('public/backend/user_images/' . $users->image);
            }
            $users['image'] = $imgName;
        }
        $users->name = $request->name;
        $users->email = $request->email;
        $users->gender = $request->gender;
        $users->mobile = $request->mobile;
        $users->address = $request->address;
        $users->save();
        return redirect()->route('profile.user.view')->with('success','Well done! profile successfully updated');
    }

    public function viewPasswordChange(){
        return view('backend.profile.user-password-change');
    }

    public function passwordUpdate(Request $request){
        $this->validate($request, [
            'old_passowrd' => 'required',
            'new_password' => 'required'
        ]);

        if(Auth::attempt(['id'=>$request->id,'password'=>$request->old_passowrd])){
            $changePassword = User::find(Auth::user()->id);
            $changePassword->password = bcrypt($request->new_password);
            $changePassword->save();
            return redirect()->route('profile.user.view')->with('success','Password Successfully Changed');
        }else{
            return redirect()->back()->with('error','The current password is not correct');
        }
    }
}
