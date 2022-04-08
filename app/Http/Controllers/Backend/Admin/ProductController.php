<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\Unit;
use App\Model\Category;
use App\Model\Supplier;
use App\Model\Product;

class ProductController extends Controller
{
    public function index(){
    	$allData = Product::where('status','1')->orderBy('supplier_id')->orderBy('category_id')->orderBy('id','DESC')->get();
    	return view('backend.admin.product.product-view', compact('allData'));
    }

    public function add(){
        $data['suppliers']  = Supplier::all();
        $data['categories'] = Category::where('status','1')->get();
    	$data['units']      = Unit::where('status','1')->get();
    	return view('backend.admin.product.product-add', $data);
    }

    public function store(Request $request){
        $data                       =  $request->all();
        $data['model_Of_vehicle']   =  $request->model_Of_vehicle ?? $request->name;
        $data['quantity'] = '0';
        Product::create($data);

        return redirect()->route('products.product.view')->with('success','Well done! successfully inserted');
    }

    public function edit($id){
        $data['editData'] = Product::find($id);
        $data['suppliers'] = Supplier::all();
        $data['categories'] = Category::where('status','1')->get();
        $data['units'] = Unit::where('status','1')->get();
    	return view('backend.admin.product.product-add', $data);
    }
    public function pdf($id){
        $data = Product::find($id);
    	return view('backend.admin.product.pdf', ['data'=> $data]);
    }

    public function update(Request $request ,$id){
        $data =  $request->all();
        $data['model_Of_vehicle']   =  $request->model_Of_vehicle ?? $request->name;
        $data['quantity'] = '0';
        $data['created_by'] = auth()->id();
        // dd($data);
        Product::find($id)->update($data);

        return redirect()->route('products.product.view')->with('success','Well done! successfully update');
    }

    public function destroy(Request $request){
        $id = $request->id;
        DB::table('products')
                ->where('id', $id)
                ->update(['status' => 0]);
        return redirect()->route('products.product.view');
    }
}
