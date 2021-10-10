<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\ReportHeading;
use App\Model\Unit;
use App\Model\Category;
use App\Model\Product;
use App\Model\Purchase;
use App\Model\Supplier;
use App\Model\Invoice;
use App\Model\Expanse;
use App\Model\StockOut;
use App\Model\StockOutDetail;
use App\Model\PurchaseDetail;
use App\Model\InvoiceDetail;
use App\Model\Reason;
use Session;
use PDF;
date_default_timezone_set("Asia/Dhaka");

class StockController extends Controller
{
    public function index(){
        $data['allData'] = StockOut::orderBy('id','desc')->get();
        return view('backend.admin.stock.stock_out_view', $data);
    }

    public function destroy(Request $request){
        $invoice = StockOut::find($request->id);
        StockOutDetail::where('stock_out_id',$invoice->id)->delete();
        $invoice->delete();
        return redirect()->route('stocks.stock.view');
    }

    public function add(){
        $data['suppliers'] = Supplier::all();
        $data['reasons'] = Reason::all();
        $data['categories'] = Category::all();
        $data['cdate'] = date('Y-m-d');
        $invoice_data = StockOut::orderBy('id','DESC')->first();
        if($invoice_data == null){
            $firstReg = 0;
            $data['stock_invoice_no'] = $firstReg+1;
        }else{
            $invoice_data = StockOut::orderBy('id','DESC')->first()->stock_invoice_no;
            $data['stock_invoice_no'] = $invoice_data+1;
        }
        return view('backend.admin.stock.stock_out_add', $data);
    }

    public function store(Request $request){
        if($request->category_id == null){
            return redirect()->back()->with('error','Sorry! Category is empty');
        }else{

            $invoice = new StockOut();
            $invoice->stock_invoice_no = $request->stock_invoice_no;
            $invoice->date = date('Y-m-d',strtotime($request->date));
            $invoice->status = '0';
            $invoice->created_by = Auth::user()->id;

            DB::transaction(function() use($request,$invoice){
                if($invoice->save()){
                    if($request->category_id !=null){
                        $count_category = count($request->category_id);
                        for ($i=0; $i < $count_category ; $i++) {
                            $invoice_details = new StockOutDetail();
                            $invoice_details->stock_out_id  = $invoice->id;
                            $invoice_details->reason_id     = $request->reason_id[$i];
                            $invoice_details->supplier_id   = $request->supplier_id[$i];
                            $invoice_details->category_id   = $request->category_id[$i];
                            $invoice_details->product_id    = $request->product_id[$i];
                            $invoice_details->quantity      = $request->quantity[$i];
                            $invoice_details->created_by    = Auth::user()->id;
                            $invoice_details->status        = '0';
                            $invoice_details->save();
                        }
                    }else{
                        return redirect()->back()->with('error','Sorry! please select any item');
                    }
                }
            });

            return redirect()->route('stocks.stock.view')->with('success','Stock out successfully completed');
        }
    }

    public function approveStkOut($id){
        $data['stock_invoice'] = StockOut::with(['stock_out_details'])->find($id);
        return view('backend.admin.stock.stock_out_approve', $data);
    }

    public function approveStore(Request $request, $id){
        foreach ($request->quantity as $key => $val) {
            $stock_out_details = StockOutDetail::where('id',$key)->first();
            $product_name = Product::where('id',$stock_out_details->product_id)->first();
            if($product_name->quantity < $request->quantity[$key]){
                return redirect()->back()->with('error','Sorry! You approve maximum value');
            }
        }
        $invoice = StockOut::find($id);
        $invoice->approved_by = Auth::user()->id;
        $invoice->status = '1';
        DB::transaction(function() use($request,$invoice,$id){
            foreach ($request->quantity as $key => $val) {
                $stock_out_details = StockOutDetail::where('id',$key)->first();
                $stock_out_details->status = '1';
                $stock_out_details->save();
                $product_name = Product::where('id',$stock_out_details->product_id)->first();
                $product_name->quantity = ((float)$product_name->quantity)-((float)$request->quantity[$key]);
                $product_name->save();
            }
            $invoice->save();
        });
        return redirect()->route('stocks.stock.view')->with('success','Stock Out Successfully Approved');
    }

    public function pdfStockOut($id){
        $data['stock_invoice'] = StockOut::with(['stock_out_details'])->find($id);
        $data['owner'] = ReportHeading::first();
        $pdf = PDF::loadView('backend.admin.stock.pdf.stock_report_pdf', $data);
        // $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function stockReport(){
        $data['suppliers'] = Supplier::all();
        return view('backend.admin.stock.daily_stock_report', $data);
    }

    public function stockReportHandlebar(Request $request){
        $supplier_id = $request->supplier_id;
        if($supplier_id !=''){
            $where[] = ['supplier_id',$supplier_id];
        }
        $category_id = $request->category_id;
        if($category_id !=''){
            $where[] = ['category_id',$category_id];
        }
        $product_id = $request->product_id;
        if($product_id !=''){
            $where[] = ['id',$product_id];
        }
        $where[] = ['status','1'];
        $data = Product::where($where)->get();
        $html['thsource'] = '<th width="5%">Sl.</th>';
        $html['thsource'] .= '<th>Supplier</th>';
        $html['thsource'] .= '<th>Category</th>';
        $html['thsource'] .= '<th>Unit</th>';
        $html['thsource'] .= '<th>Product Name</th>';
        $html['thsource'] .= '<th>In</th>';
        $html['thsource'] .= '<th>Out</th>';
        $html['thsource'] .= '<th>Stock</th>';
        $html['tdsource']  = '';
        $in_grand = 0;
        $out_grand = 0;
        $grand_total = 0;
        foreach ($data as $key => $v) {
            $buying_qty = PurchaseDetail::where('supplier_id',$v->supplier_id)->where('category_id',$v->category_id)->where('product_id',$v->id)->where('status','1')->sum('buying_qty');
            $buying_free_qty = PurchaseDetail::where('supplier_id',$v->supplier_id)->where('category_id',$v->category_id)->where('product_id',$v->id)->where('status','1')->sum('free_quantity');
            $total_in_qty = $buying_qty+$buying_free_qty;
            $selling_qty = InvoiceDetail::where('category_id',$v->category_id)->where('product_id',$v->id)->where('status','1')->sum('selling_qty');
            $selling_free_qty = InvoiceDetail::where('category_id',$v->category_id)->where('product_id',$v->id)->where('status','1')->sum('free_selling_qty');
            $stock_out_qty = StockOutDetail::where('category_id',$v->category_id)->where('product_id',$v->id)->where('status','1')->sum('quantity');
            $total_out_qty = $selling_qty+$selling_free_qty+$stock_out_qty;
            $stock = $total_in_qty+$stock_out_qty;

            $html['tdsource'] .= '<tr>';
            $html['tdsource'] .= '<td>'.($key+1).'</td>';
            $html['tdsource'] .= '<td>'.@$v['supplier']['name'].'</td>';
            $html['tdsource'] .= '<td>'.@$v['category']['name'].'</td>';
            $html['tdsource'] .= '<td>'.@$v['unit']['name'].'</td>';
            $html['tdsource'] .= '<td>'.@$v->name.'</td>';
            $html['tdsource'] .= '<td>'.round($total_in_qty,2).'</td>';
            $html['tdsource'] .= '<td>'.round($total_out_qty,2).'</td>';
            $html['tdsource'] .= '<td>'.$stock.'</td>';
            $html['tdsource'] .= '</tr>';
            $in_grand += $total_in_qty;
            $out_grand += $total_out_qty;
            $grand_total += $stock;
        }
        $html['tdsource'] .= '<tr>';
        $html['tdsource'] .= '<td colspan="5" class="text-right">'.'Grand Total'.'</td>';
        $html['tdsource'] .= '<td>'.$in_grand.'</td>';
        $html['tdsource'] .= '<td>'.$out_grand.'</td>';
        $html['tdsource'] .= '<td>'.$grand_total.'</td>';
        $html['tdsource'] .= '</tr>';
        return response()->json(@$html);
    }

    public function stockReportPdf(Request $request){
        $supplier_id = $request->supplier_id;
        if($supplier_id !=''){
            $where[] = ['supplier_id',$supplier_id];
        }
        $category_id = $request->category_id;
        if($category_id !=''){
            $where[] = ['category_id',$category_id];
        }
        $product_id = $request->product_id;
        if($product_id !=''){
            $where[] = ['id',$product_id];
        }
        $where[] = ['status','1'];
        $data['allData'] = Product::orderBy('supplier_id')->where($where)->get();
        $data['owner'] = ReportHeading::first();
        // return view('backend.admin.stock.pdf.daily_stock_report_pdf', $data);
        $pdf = PDF::loadView('backend.admin.stock.pdf.daily_stock_report_pdf', $data);
        // $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
