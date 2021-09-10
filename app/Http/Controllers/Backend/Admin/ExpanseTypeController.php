<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\ExpanseType;

class ExpanseTypeController extends Controller
{
    public function viewType(){
    	$allData = ExpanseType::where('status','1')->get();
    	return view('backend.admin.expanse.expanse_type_view', compact('allData'));
    }

    public function addType(){
    	return view('backend.admin.expanse.expanse_type_add');
    }

    public function storeType(Request $request){
        $this->validate($request,[
            'name' => 'required|unique:expanse_types,name'
        ]);
        $data = new ExpanseType();
        $data->name = $request->name;
        $data->created_by = Auth::user()->id;
        $data->save();
        return redirect()->route('expanses.type.view')->with('success','Well done! successfully inserted');
    }

    public function editType($id){
        $editData = ExpanseType::find($id);
        return view('backend.admin.expanse.expanse_type_add', compact('editData'));
    }

    public function updateType(Request $request ,$id){
        $data = ExpanseType::find($id);
        $this->validate($request,[
            'name' => 'required|unique:expanse_types,name,'.$data->id
        ]);
        $data->name = $request->name;
        $data->updated_by = Auth::user()->id;
        $data->save();
        return redirect()->route('expanses.type.view')->with('success','Well done! successfully update');
    }

    public function destroy(Request $request){
        $id = $request->id;
        DB::table('products')
                ->where('id', $id)
                ->update(['status' => 0]);
        return redirect()->route('expanses.type.view');
    }
}
