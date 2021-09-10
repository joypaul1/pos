<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\Unit;

class UnitController extends Controller
{
    public function index(){
    	$allData = Unit::where('status','1')->get();
    	return view('backend.admin.unit-view', compact('allData'));
    }

    public function add(){
    	return view('backend.admin.unit-add');
    }

    public function store(Request $request){
        $data = new Unit();
        $data->name = $request->name;
        $data->created_by = Auth::user()->id;
        $data->save();
        return redirect()->route('units.unit.view')->with('success','Well done! successfully inserted');
    }

    public function edit($id){
        $editData = Unit::find($id);
        return view('backend.admin.unit-add', compact('editData'));
    }

    public function update(Request $request ,$id){
        $data = Unit::find($id);
        $data->name = $request->name;
        $data->modified_by = Auth::user()->id;
        $data->save();
        return redirect()->route('units.unit.view')->with('success','Well done! successfully update');
    }

    public function destroy(Request $request){
        $id = $request->id;
        DB::table('products')
                ->where('id', $id)
                ->update(['status' => 0]);
        return redirect()->route('units.unit.view');
    }
}
