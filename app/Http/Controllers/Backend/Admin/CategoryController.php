<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\Category;

class CategoryController extends Controller
{
    public function index(){
    	$allData = Category::where('status','1')->get();
    	return view('backend.admin.category-view', compact('allData'));
    }

    public function add(){
    	return view('backend.admin.category-add');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|unique:categories,name'
        ]);
        $data = new Category();
        $data->name = $request->name;
        $data->created_by = Auth::user()->id;
        $data->save();
        return redirect()->route('categories.category.view')->with('success','Well done! successfully inserted');
    }

    public function edit($id){
        $editData = Category::find($id);
        return view('backend.admin.category-add', compact('editData'));
    }

    public function update(Request $request ,$id){
        $data = Category::find($id);
        $this->validate($request,[
            'name' => 'required|unique:categories,name,'.$data->id
        ]);
        $data->name = $request->name;
        $data->modified_by = Auth::user()->id;
        $data->save();
        return redirect()->route('categories.category.view')->with('success','Well done! successfully update');
    }

    public function destroy(Request $request){
        $id = $request->id;
        DB::table('products')
                ->where('id', $id)
                ->update(['status' => 0]);
        return redirect()->route('categories.category.view');
    }
}
