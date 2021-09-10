<?php

namespace App\Http\Controllers\Backend\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\User;
use App\Model\ReportHeading;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('backend.user.user-view', compact('users'));
    }

    public function add(){
        return view('backend.user.user-add');
    }

    public function store(Request $request){
        $this->validate($request,[
            'email'=>'required|unique:users,email'
        ]);

        $users = new User();
        $users->usertype = $request->usertype;
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = bcrypt($request->password);
        $users->status = $request->status;
        $img = $request->file('image');
        $users->created_by = Auth::user()->id;
        $users->status = '1';

        if ($img) {
            $imgName = md5(str_random(30) . time() . '_' . $img) . '.' . $img->getClientOriginalExtension();
            $request->file('image')->move('public/backend/user_images/', $imgName);
            $users['image'] = $imgName;
        }

        // echo "<pre>"; print_r($users); exit();

        $users->save();
        return redirect()->route('user.view')->with('success','Well done! successfully inserted');
    }

    public function edit($id){
        $editData = User::find($id);
        return view('backend.user.user-add', compact('editData'));
    }

    public function update(UserRequest $request ,$id){
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
        $users->usertype = $request->usertype;
        $users->name = $request->name;
        $users->email = $request->email;
        $users->modified_by = Auth::user()->id;
        $users->save();
        return redirect()->route('user.view')->with('success','Well done! successfully updated');
    }
    
    public function destroy(Request $request){    
        $user = User::find($request->id);
        unlink('public/backend/user_images/'.$user->image);
        $user->delete();
        return redirect()->route('user.view');
    }

    //Active & Inactive
    public function inactive($id){
        DB::table('users')
                ->where('id', $id)
                ->update(['status' => 0]);
        return redirect()->route('user.view')->with('success','Well done! status updated');
    }

    public function active($id){
        DB::table('users')
                ->where('id', $id)
                ->update(['status' => 1]);
        return redirect()->route('user.view')->with('success','Well done! status updated');
    }

    public function shopView(){
        $data['allData'] = ReportHeading::all();
        $data['count'] = ReportHeading::count();
        return view('backend.admin.shop.shop_view', $data);
    }

    public function shopAdd(){
        return view('backend.admin.shop.shop_add');
    }

    public function shopStore(Request $request){
        $data = new ReportHeading();
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->created_by = Auth::user()->id;
        $img = $request->file('image');

        if ($img) {
            $imgName = md5(str_random(30) . time() . '_' . $img) . '.' . $img->getClientOriginalExtension();
            $request->file('image')->move('public/backend/user_images/', $imgName);
            $data['image'] = $imgName;
        }

        $data->save();
        return redirect()->route('user.shop.view')->with('success','Well done! successfully inserted');
    }

    public function shopEdit($id){
        $data['editData'] = ReportHeading::find($id);
        return view('backend.admin.shop.shop_add', $data);
    }

    public function shopUpdate(Request $request ,$id){
        $data = ReportHeading::find($id);
        
        $img = $request->file('image');
        if ($img) {
            $imgName = md5(str_random(30) . time() . '_' . $img) . '.' . $img->getClientOriginalExtension();
            $request->file('image')->move('public/backend/user_images/', $imgName);
            if (file_exists('public/backend/user_images/' . $data->image) AND ! empty($data->image)) {
                unlink('public/backend/user_images/' . $data->image);
            }
            $data['image'] = $imgName;
        }
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->modified_by = Auth::user()->id;
        $data->save();
        return redirect()->route('user.shop.view')->with('success','Well done! successfully updated');
    }
}
