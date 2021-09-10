<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Unit;
use App\Model\Category;
use App\Model\Product;
use App\Model\Purchase;
use App\Model\Stock;
use App\Model\Supplier;
use App\Model\Customer;
use App\Model\Flat;
use App\Model\Invoice;
use App\Model\Floor;
use App\Model\Contactor;
use App\Model\ContactorInvoice;
use App\Model\PurchaseDetail;

class DefaultController extends Controller
{
    public function getCategory(Request $request){
        $supplier_id = $request->supplier_id;
        $allCategory = Product::select('category_id')->with(['category'])->where('supplier_id',$supplier_id)->groupBy('category_id')->get();
        // dd($allCategory);
        return response()->json($allCategory);
    }

    public function getProduct(Request $request){
        $category_id = $request->category_id;
        $products = Product::where('category_id',$category_id)->get();
        return response()->json($products);
    }

    public function getProductCount(Request $request){
        $category_id = $request->category_id;
        $product_id = $request->product_id;
        $stock = PurchaseDetail::where('category_id',$category_id)->where('product_id',$product_id)->orderBy('id','desc')->first();
        $qty = $stock->selling_price;
        return response()->json($qty);
    }

    public function getProductStock(Request $request){
        $product_id = $request->product_id;
        $qty = Product::where('id',$product_id)->first();
        $stock = $qty->quantity;
        return response()->json($stock);
    }

    public function getProductCategory(Request $request){
        $supplier_id = $request->supplier_id;
        $allData = Product::select('category_id')->with(['category'])->where('supplier_id',$supplier_id)->groupBy('category_id')->get();
        return response()->json($allData);
    }

}
