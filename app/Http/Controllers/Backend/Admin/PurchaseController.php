<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\ReportHeading;
use App\Model\Unit;
use App\Model\Category;
use App\Model\Supplier;
use App\Model\Product;
use App\Model\Purchase;
use App\Model\PurchaseDetail;
use App\Model\PurchasePayment;
use App\Model\PurchasePaymentDetail;
use App\Model\PurchaseRepayment;
use Session;
use PDF;


class PurchaseController extends Controller
{
    public function index(){
    	$allData = Purchase::orderBy('date','desc')->orderBy('id','desc')->get();
    	return view('backend.admin.purchase.purchase-view', compact('allData'));
    }

    public function add(){
        $purchase = Purchase::orderBy('id','DESC')->first();
        if($purchase){
            $data['invoice_no'] = str_pad($purchase->purchase_no, 7 , "0", STR_PAD_LEFT);
        }else{
            $data['invoice_no'] = str_pad(1, 7 , "0", STR_PAD_LEFT);
        }

        $data['suppliers'] = Supplier::all();
        $data['cdate'] = date("Y-m-d");
    	return view('backend.admin.purchase.purchase-add', $data);
    }

    public function store(Request $request){
        $checkPurchaseNo = Purchase::where('purchase_no',$request->purchase_no)->first();
        if($checkPurchaseNo != null){
            return redirect()->back()->with('error','Sorry! Purchase no is already exists');
        }else{
            if($request->estimated_amount<$request->paid_amount){
                return redirect()->back()->with('error','Sorry! Paid price is Large then total price');
            }else{
                $purchase = new Purchase();
                $purchase->purchase_no = $request->purchase_no;
                $purchase->date = date('Y-m-d',strtotime($request->date));
                $purchase->description = $request->description;
                $purchase->status = '0';
                $purchase->created_by = Auth::user()->id;
                DB::transaction(function() use($request,$purchase){
                    if($purchase->save()){
                        if($request->category_id !=null){
                            $count_category = count($request->category_id);
                            for ($i=0; $i <$count_category ; $i++) {
                                $purchase_details = new PurchaseDetail();
                                $purchase_details->purchase_id = $purchase->id;
                                $purchase_details->date = date('Y-m-d',strtotime($request->date));
                                $purchase_details->supplier_id = $request->supplier_id;
                                $purchase_details->category_id = $request->category_id[$i];
                                $purchase_details->product_id = $request->product_id[$i];
                                $purchase_details->buying_qty = $request->buying_qty[$i];
                                $purchase_details->unit_price = $request->unit_price[$i];
                                $purchase_details->buying_price = $request->buying_price[$i];
                                $purchase_details->selling_price = $request->selling_price[$i];
                                if ($request->free_quantity !=null) {
                                    $purchase_details->free_quantity = $request->free_quantity[$i];
                                }else{
                                    $purchase_details->free_quantity = '0';
                                }
                                $purchase_details->created_by = Auth::user()->id;
                                $purchase_details->status = '0';
                                $purchase_details->save();
                            }

                            $payment = new PurchasePayment();
                            $payment_details = new PurchasePaymentDetail();
                            $payment->purchase_id = $purchase->id;
                            $payment->supplier_id = $request->supplier_id;
                            $payment->paid_status = $request->paid_status;
                            $payment->payment_method = $request->payment_method;
                            $payment->total_amount = $request->estimated_amount;
                            // $payment->date = date('Y-m-d',strtotime($request->date));
                            if($request->paid_status=='full_paid'){
                                $payment->paid_amount = $request->estimated_amount;
                                $payment->due_amount = '0';
                                $payment_details->current_paid_amount = $request->estimated_amount;
                            }elseif($request->paid_status=='full_due'){
                                $payment->paid_amount = '0';
                                $payment->due_amount = $request->estimated_amount;
                                $payment_details->current_paid_amount = '0';
                            }elseif($request->paid_status=='partial_paid'){
                                $payment->paid_amount = $request->paid_amount;
                                $payment->due_amount = $request->estimated_amount-$request->paid_amount;
                                $payment_details->current_paid_amount = $request->paid_amount;
                            }
                            $payment->save();
                            $payment_details->purchase_id = $purchase->id;
                            $payment_details->created_by = Auth::user()->id;
                            $payment_details->date = date('Y-m-d',strtotime($request->date));
                            $payment_details->bank_name = $request->bank_name;
                            $payment_details->cheque_no = $request->cheque_no;
                            $payment_details->save();
                        }else{
                            return redirect()->back()->with('error','Sorry! please select any item');
                        }
                    }
                });

                return redirect()->route('purchases.purchase.view')->with('success','Well done! successfully inserted');
            }
        }
    }

    public function destroy(Request $request){
        $purchase = Purchase::find($request->id);
        PurchaseDetail::where('purchase_id',$purchase->id)->delete();
        PurchasePayment::where('purchase_id',$purchase->id)->delete();
        PurchasePaymentDetail::where('purchase_id',$purchase->id)->delete();
        $purchase->delete();
        return redirect()->route('purchases.purchase.view');
    }

    public function purchaseApproval($id){
        $purchase = Purchase::with(['purchase_details'])->find($id);
        if($purchase->status=='0'){
            return view('backend.admin.purchase.purchase_approval', compact('purchase'));
        }elseif($purchase->status=='2'){
            return view('backend.admin.purchase.purchase_update_approval', compact('purchase'));
        }
    }

    public function purchaseApprovalStore(Request $request,$id){

        $purchase = Purchase::find($id);
        $purchase->approved_by = Auth::user()->id;
        $purchase->status = '1';
        DB::transaction(function() use($request,$purchase,$id){
            foreach ($request->buying_qty as $key => $val) {
                $purchase_details = PurchaseDetail::where('id',$key)->first();
                $purchase_details->status = '1';
                $purchase_details->save();
                $product_name = Product::where('id',$purchase_details->product_id)->first();
                $product_name->free_quantity = ((float)$product_name->free_quantity)+((float)$request->free_quantity[$key]);
                $product_name->quantity = ((float)$product_name->quantity)+((float)$request->buying_qty[$key]);
                $product_name->save();
            }

            $supplier = Supplier::where('id',$request->supplier_id)->first();
            $supplier->total_amount = ((float)($supplier->total_amount))+((float)($request->supplier_total_amount));
            $supplier->payment = ((float)($supplier->payment))+((float)($request->supplier_paid_amount));
            $supplier->due = ((float)($supplier->due))+((float)($request->supplier_due_amount));
            $supplier->save();
            $purchase->save();
        });
        return redirect()->route('purchases.purchase.view')->with('success','Purchase Successfully Approved');

    }

    public function dueList()
    {
        $allData = PurchasePayment::whereIn('paid_status',['full_due','partial_paid'])->orderBy('id','desc')->get();
        return view('backend.admin.purchase.purchase_due_list', compact('allData'));
    }

    public function purchaseEdit($purchase_id)
    {
        $purchase = PurchasePayment::where('purchase_id',$purchase_id)->first();
        return view('backend.admin.purchase.purchase_edit', compact('purchase'));
    }

    public function purchaseUpdate(Request $request, $purchase_id)
    {
        if($request->new_paid_amount<$request->paid_amount){
            return redirect()->back()->with('error','Sorry! you have paid maximum value');
        }else{
            $purchase = Purchase::where('id',$purchase_id)->first();
            $purchase->status = '2';
            $purchase->save();
            $purchase_repayment = new PurchaseRepayment();
            $purchase_repayment->purchase_id = $purchase_id;
            $purchase_repayment->supplier_id = $request->supplier_id;
            $purchase_repayment->new_paid_amount = $request->new_paid_amount;
            $purchase_repayment->date = date('Y-m-d',strtotime($request->date));
            $purchase_repayment->payment_method = $request->payment_method;
            $purchase_repayment->paid_status = $request->paid_status;
            $purchase_repayment->paid_amount = $request->paid_amount;
            $purchase_repayment->bank_name = $request->bank_name;
            $purchase_repayment->cheque_no = $request->cheque_no;
            $purchase_repayment->save();
            return redirect()->route('purchases.purchase.due')->with('success','Purchase Successfully Updated');
        }
    }

    public function purchaseUpdateApprovalStore(Request $request, $purchase_id)
    {
        if($request->new_paid_amount<$request->paid_amount){
            return redirect()->back()->with('error','Sorry! you have paid maximum value');
        }else{
            $purchase = Purchase::where('id',$purchase_id)->first();
            $purchase->status = '1';
            $purchase_payment = PurchasePayment::where('purchase_id',$purchase_id)->first();
            $supplier = Supplier::where('id',$request->supplier_id)->first();
            $purchase_payment_details = new PurchasePaymentDetail();
            $purchase_payment->paid_status = $request->paid_status;

            if($request->paid_status=='full_paid'){
                $purchase_payment->paid_amount = PurchasePayment::where('purchase_id',$purchase_id)->first()['paid_amount']+$request->new_paid_amount;
                $purchase_payment->due_amount = '0';
                $purchase_payment_details->current_paid_amount = $request->new_paid_amount;
                $supplier->payment = ((float)($supplier->payment))+((float)($request->new_paid_amount));
                $supplier->due = ((float)($supplier->due))-((float)($request->new_paid_amount));
            }elseif($request->paid_status=='partial_paid'){
                $purchase_payment->paid_amount = PurchasePayment::where('purchase_id',$purchase_id)->first()['paid_amount']+$request->paid_amount;
                $purchase_payment->due_amount = PurchasePayment::where('purchase_id',$purchase_id)->first()['due_amount']-$request->paid_amount;
                $purchase_payment_details->current_paid_amount = $request->paid_amount;
                $supplier->payment = ((float)($supplier->payment))+((float)($request->paid_amount));
                $supplier->due = ((float)($supplier->due))-((float)($request->paid_amount));
            }

            $purchase_payment_details->purchase_id = $purchase_id;
            $purchase_payment_details->date = date('Y-m-d');
            $purchase_payment_details->bank_name = $request->bank_name;
            $purchase_payment_details->cheque_no = $request->cheque_no;
            $purchase_payment_details->created_by = Auth::user()->id;
            $purchase_payment_details->save();

            $supplier->save();
            $purchase_payment->save();
            $purchase->save();

            PurchaseRepayment::where('id',$request->purchase_repayment_id)->delete();

            return redirect()->route('purchases.purchase.view')->with('success','Purchase Successfully Approved');
        }
    }

    public function purchaseReject(Request $request){
        $purchase_repayment = PurchaseRepayment::find($request->id);
        $purchase = Purchase::where('id',$purchase_repayment->purchase_id)->first();
        $purchase->status = '1';
        $purchase->save();
        $purchase_repayment->delete();
        return redirect()->route('purchases.purchase.view')->with('success','Purchase Successfully Rejected');
    }

    public function purchasePdf($id){
        $data['purchase'] = Purchase::with(['purchase_details','purchase_payment_details'])->find($id);
        $data['owner'] = ReportHeading::first();
        return view('backend.admin.purchase.pdf.purchase_print_pdf', $data);
        // $pdf = PDF::loadView('backend.admin.purchase.pdf.purchase_print_pdf', $data);
        // $pdf->SetProtection(['copy', 'print'], '', 'pass');
        // $pdf->stream('document.pdf');
    }

    public function purchaseDetails($purchase_id)
    {
        $data['purchase'] = PurchasePayment::where('purchase_id',$purchase_id)->first();
        $data['owner'] = ReportHeading::first();
        $pdf = PDF::loadView('backend.admin.purchase.pdf.purchase_details_pdf', $data);
        // $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function dailyPurchase(Request $request){
        $data['suppliers'] = Supplier::all();
        return view('backend.admin.purchase.daily-purchase-report', $data);
    }

    public function dailyPurchaseHandlebar(Request $request){

        $supplier_id = $request->supplier_id;
        if($supplier_id !=''){
            $where[] = ['supplier_id',$supplier_id];
        }
        $where[]        = ['status','1'];
        $start_date     = date('Y-m-d',strtotime($request->start_date));
        $end_date       = date('Y-m-d',strtotime($request->end_date));
        $allPurchases   = PurchaseDetail::whereBetween('date',[$start_date, $end_date])
                            ->orderBy('supplier_id')->where($where)->get();

        $html['tdsource']  = '';
        $total_sum = 0;
        $html['tdsource'] .= '<tr>';
        $html['tdsource'] .= '<td colspan="9" class="text-center">'.'PURCHASE REPORT'.date('d-m-Y',strtotime($start_date)).'-'.date('d-m-Y',strtotime($end_date)).'</td>';
        $html['tdsource'] .= '</tr>';

        $html['tdsource'] .= '<tr>';
        $html['tdsource'] .= '<td>'.'SL'.'</td>';
        $html['tdsource'] .= '<td>'.'Date'.'</td>';
        $html['tdsource'] .= '<td>'.'Memo No'.'</td>';
        $html['tdsource'] .= '<td>'.'Supplier'.'</td>';
        $html['tdsource'] .= '<td>'.'Product'.'</td>';
        $html['tdsource'] .= '<td>'.'Qty'.'</td>';
        $html['tdsource'] .= '<td>'.'Unit Price'.'</td>';
        $html['tdsource'] .= '<td>'.'Amount'.'</td>';
        $html['tdsource'] .= '</tr>';

        foreach ($allPurchases as $key => $v) {
            $html['tdsource'] .= '<tr>';
            $html['tdsource'] .= '<td>'.($key+1).'</td>';
            $html['tdsource'] .= '<td>'.date('d-m-Y',strtotime(@$v->date)).'</td>';
            $html['tdsource'] .= '<td>'.'#' .@$v['purchase']['purchase_no'].'</td>';
            $html['tdsource'] .= '<td>'.@$v['supplier']['name'].'</td>';
            $html['tdsource'] .= '<td>'.@$v['product']['name'].'</td>';
            $html['tdsource'] .= '<td>'.@$v->buying_qty.'</td>';
            $html['tdsource'] .= '<td>'.@$v->unit_price.'</td>';
            $html['tdsource'] .= '<td>'.@$v->buying_price.'</td>';
            $html['tdsource'] .= '</tr>';
            $total_sum += $v->buying_price;
        }
        $html['tdsource'] .= '<tr>';
        $html['tdsource'] .= '<td colspan="7" class="text-right">'.'Grand Total'.'</td>';
        $html['tdsource'] .= '<td>'.@$total_sum.'TK'.'</td>';
        $html['tdsource'] .= '</tr>';
        return response()->json(@$html);
    }

    public function dailyPurchasePdf(Request $request){

        $supplier_id = $request->supplier_id;
        if($supplier_id !=''){
            $where= ['supplier_id', $supplier_id];
        }
        $where[]            = ['status','1'];
        $start_date         = date('Y-m-d',strtotime($request->start_date));
        $end_date           = date('Y-m-d',strtotime($request->end_date));
        $data['start_date'] = date('Y-m-d',strtotime($request->start_date));
        $data['end_date']   = date('Y-m-d',strtotime($request->end_date));

         $data['allPurchases'] = PurchaseDetail::whereBetween('date',[$start_date, $end_date])->orderBy('supplier_id')
        ->where([$where], ['status','1'])
        ->get();
        $data['owner'] = ReportHeading::first();

        $pdf = PDf::loadView('backend.admin.purchase.pdf.daily-purchase-report-pdf', $data);
        return $pdf->stream("Daily-purchase-report->" .date('d-m-Y'));
    }
}
