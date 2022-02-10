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
use App\Model\InvoiceDetail;
use App\Model\PurchaseDetail;
use App\Model\StockOutDetail;

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
        $products   = Product::where('category_id',$category_id)->get(['id','name']);
        $pname      = Product::where('category_id',$category_id)->get(['id','pname']);
        $pid        = Product::where('category_id',$category_id)->get(['id','pid']);
        $pmname    = Product::where('category_id',$category_id)->get(['id','pmname']);

        return response()->json([ 'products' =>$products, 'pname'=> $pname, 'pid' => $pid, 'pmname' => $pmname]);
    }
    public function validProduct(Request $request){
        $category_id = $request->category_id;
        $products   = Product::where('category_id',$category_id)->has('checkPurchase')->get(['id','name']);
        $pname      = Product::where('category_id',$category_id)->has('checkPurchase')->get(['id','pname']);
        $pid        = Product::where('category_id',$category_id)->has('checkPurchase')->get(['id','pid']);
        $pmname    = Product::where('category_id',$category_id)->has('checkPurchase')->get(['id','pmname']);
        return response()->json([ 'products' =>$products, 'pname'=> $pname, 'pid' => $pid, 'pmname' => $pmname]);
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
        // $qty = Product::where('id',$product_id)->first();
        // $stock = $qty->quantity;
        $buying_qty = PurchaseDetail::where('product_id', $product_id)->where('status','1')->sum('buying_qty');
        $buying_free_qty = PurchaseDetail::where('product_id',$product_id)->where('status','1')->sum('free_quantity');
        $total_in_qty = $buying_qty+$buying_free_qty;
        $selling_qty = InvoiceDetail::where('product_id',$product_id)->where('status','1')->sum('selling_qty');
        $selling_free_qty = InvoiceDetail::where('product_id',$product_id)->where('status','1')->sum('free_selling_qty');
        $stock_out_qty = StockOutDetail::where('product_id',$product_id)->where('status','1')->sum('quantity');
        $total_out_qty = $selling_qty+$selling_free_qty+$stock_out_qty;
        $stock = $total_in_qty-$total_out_qty;

        return response()->json($stock);
    }

    public function getProductCategory(Request $request){
        $supplier_id = $request->supplier_id;
        $allData = Product::select('category_id')->with(['category'])->where('supplier_id',$supplier_id)->groupBy('category_id')->get();
        return response()->json($allData);
    }

}
