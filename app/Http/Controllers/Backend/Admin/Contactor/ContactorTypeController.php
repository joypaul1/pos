<?php

namespace App\Http\Controllers\Backend\Admin\Contactor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\Reason;

class ContactorTypeController extends Controller
{
    //Contactor Type used for Reason
    public function index(){
    	$allData = Reason::where('status','1')->get();
    	return view('backend.admin.contactor.type.type_view', compact('allData'));
    }

    public function add(){
    	return view('backend.admin.contactor.type.type_add');
    }

    public function store(Request $request){
        $data = new Reason();
        $data->name = $request->name;
        $data->created_by = Auth::user()->id;
        $data->save();
        return redirect()->route('stocks.reason.view')->with('success','Well done! successfully inserted');
    }

    public function edit($id){
        $editData = Reason::find($id);
        return view('backend.admin.contactor.type.type_add', compact('editData'));
    }

    public function update(Request $request ,$id){
        $data = Reason::find($id);
        $data->name = $request->name;
        $data->modified_by = Auth::user()->id;
        $data->save();
        return redirect()->route('stocks.reason.view')->with('success','Well done! successfully update');
    }
}
