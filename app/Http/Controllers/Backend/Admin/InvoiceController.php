<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\Unit;
use App\Model\Category;
use App\Model\Product;
use App\Model\Purchase;
use App\Model\Customer;
use App\Model\Supplier;
use App\Model\ReportHeading;
use App\Model\Invoice;
use App\Model\InvoiceDetail;
use App\Model\InvoicePayment;
use App\Model\InvoicePaymentDetail;
use App\Model\InvoicePaymentDueLog;
use App\Model\InvoiceRepayment;
use App\Models\Installment;
use Carbon\Carbon;
use Session;
use PDF;

date_default_timezone_set("Asia/Dhaka");

class InvoiceController extends Controller
{
    public function index(){
    	$allData = Invoice::orderBy('date','desc')->orderBy('id','desc')->get();
    	return view('backend.admin.invoice.invoice-view', compact('allData'));
    }

    public function customerDueBalance(Request $request){
        $customer_id = $request->customer_id;
        $dues = Customer::where('id',$customer_id)->first();
        $total_due = $dues->due;
        return response()->json($total_due);
    }

    public function add(){

    	$data['categories'] = Category::all();
        $data['customers']  = Customer::all();
        $data['cdate']      = date('Y-m-d');
        $invoice_data       = Invoice::orderBy('id','DESC')->first();
        if($invoice_data == null){
            $data['invoice_no'] = str_pad(1, 7, "0", STR_PAD_LEFT);
        }else{
            $invoice_data = Invoice::orderBy('id','DESC')->first()->invoice_no;
            $data['invoice_no'] = str_pad($invoice_data+1, 7, "0", STR_PAD_LEFT);
        }

    	return view('backend.admin.invoice.invoice-add', $data);
    }

    public function store(Request $request){

        if($request->estimated_amount <= $request->paid_amount){
            return redirect()->back()->with('error','Sorry! Paid price is Large then total price');
        }else{
            $invoice_data = Invoice::orderBy('id','DESC')->first();
            if($invoice_data == null){
                $invoice_no = str_pad(1, 7, "0", STR_PAD_LEFT);
            }else{
                $invoice_data = Invoice::orderBy('id','DESC')->first()->invoice_no;
                $invoice_no = str_pad($invoice_data+1, 7, "0", STR_PAD_LEFT);
            }

            $invoice['grand_total']   = $request->estimated_amount;
            $invoice['total_amount']  = $request->estimated_amount;
            $invoice['invoice_no']    = $invoice_no;
            $invoice['date']          = date('Y-m-d',strtotime($request->date));
            $invoice['description']   = $request->description??' ';
            $invoice['customer_id']   = $request->customer_id;
            if($request->paid_status == "full_paid"){
                $invoice['paid_amount']   = $request->estimated_amount??0;
            }else{
                $invoice['paid_amount']   = $request->paid_amount??0;

            }
            // dd($invoice);
            try {
                DB::transaction(function() use($request, $invoice){

                        $invoice = Invoice::create($invoice);
                        if($request->category_id !=null){
                            for ($i=0; $i < count($request->category_id) ; $i++) {
                                $invoice_details['invoice_id']    = $invoice->id;
                                $invoice_details['customer_id']   = $request->customer_id;
                                $invoice_details['date']          = date('Y-m-d',strtotime($request->date));
                                $invoice_details['category_id']   = $request->category_id[$i];
                                $invoice_details['product_id']    = $request->product_id[$i];
                                $invoice_details['selling_qty']   = $request->selling_qty[$i];
                                $invoice_details['selling_price'] = $request->selling_price[$i];
                                $invoice_details['unit_price']    = $request->unit_price[$i];
                                $invoice_details['atcual_total_price'] = $request->unit_price[$i] *$request->selling_qty[$i] ;
                                $invoice_details['total_price'] = $request->selling_price[$i] *$request->selling_qty[$i] ;
                                if ($request->free_selling_qty[$i]) {
                                    $invoice_details['free_selling_qty'] = $request->free_selling_qty[$i];
                                }else{
                                    $invoice_details['free_selling_qty'] = '0';
                                }
                                if ($request->serial_no[$i]) {
                                    $invoice_details['serial_no'] = $request->serial_no[$i];
                                }else{
                                    $invoice_details['serial_no'] = '0';
                                }
                                if ($request->warranty[$i]) {
                                    $invoice_details['warranty'] = $request->warranty[$i];
                                }else{
                                    $invoice_details['warranty'] = '0';
                                }
                                InvoiceDetail::create($invoice_details);
                            }

                            $payment['invoice_id']      = $invoice->id;
                            $payment['customer_id']     = $request->customer_id;
                            $payment['paid_status']     = $request->paid_status;
                            $payment['payment_method']  = $request->payment_method;
                            $payment['total_amount']    = $request->estimated_amount;
                            $payment['date']            = date('Y-m-d',strtotime($request->date));

                            if($request->paid_status=='full_paid'){
                                $payment['paid_amount'] = $request->estimated_amount;
                            }else{
                                $payment['paid_amount'] = $request->paid_amount??0;
                            }

                            $invoicePayment = InvoicePayment::create($payment);

                            if (!empty($request->installmentDate && $request->installAmount)) {
                                $invoice->installment()->create([
                                    'payment_id'   =>  $invoicePayment->id,
                                    'customer_id'   => $request->customer_id,
                                    'amount'        => $request->installAmount,
                                    'interest'      => $request->installInterest,
                                    'date'          => date('Y-m-d',strtotime($request->installmentDate)),
                                ]);
                            }

                        }else{
                            return redirect()->back()->with('error','Sorry! please select any item');
                        }
                    // }
                });
            } catch (\Exception $ex) {
                dd($ex->getMessage(), $ex->getLine());
            }

            return redirect()->route('invoices.invoice.view')->with('success','Well done! successfully inserted');
        }
    }

    public function destroy(Request $request){
        $invoice = Invoice::find($request->id);
        $invoice->installment()->delete();
        $invoice->invoice_payment()->delete();
        $invoice->invoice_details()->delete();
        $invoice->delete();

        // InvoiceDetail::where('invoice_id',$invoice->id)->delete();
        // InvoicePayment::where('invoice_id',$invoice->id)->delete();
        // InvoicePaymentDetail::where('invoice_id',$invoice->id)->delete();
        // InvoicePaymentDueLog::where('invoice_id',$invoice->id)->delete();
        //
        return redirect()->route('invoices.invoice.view');
    }

    public function invoiceApprove($id){

        Invoice::whereId($id)->update(['status' => 1]);
        return redirect()->route('invoices.invoice.view')->with('success','Invoice Successfully Approved');
        // $date = Carbon::parse('2016-09-17 11:00:00');
        // $now = Carbon::now();
        // $diff = $date->diffInDays($now);
        // $invoice = Invoice::with(['installment' => function($query){
        //     $query->select('customer_id', 'invoice_id','status','amount','interest', 'date')->orderBy('date');
        // }])->find($id);

        // if($invoice->status =='0'){
        //     $cdate = date('Y-m-d');
        //     return view('backend.admin.invoice.invoice_approve', compact('invoice','cdate'));
        // }elseif($invoice->status =='2'){
        //     $invoice_repayment = InvoiceRepayment::where('invoice_id',$invoice->id)->first();
        //     $invoice = Invoice::with(['invoice_details','invoice_payment_details'])->where('id',$invoice_repayment->invoice_id)->first();

        //     $cdate = date('Y-m-d');
        //     return view('backend.admin.invoice.invoice_update_approve', compact('invoice_repayment','cdate','invoice'));
        // }
    }

    public function invoiceApproveStore(Request $request,$id){
        if($request->free_selling_qty !=null){
            foreach ($request->free_selling_qty as $key => $val) {
                $invoice_details = InvoiceDetail::where('id',$key)->first();
                $product_name = Product::where('id',$invoice_details->product_id)->first();
                if($product_name->free_quantity < $request->free_selling_qty[$key]){
                    return redirect()->back()->with('error','Sorry! You approve maximum value');
                }
            }
        }
        foreach ($request->selling_qty as $key => $val) {
            $invoice_details = InvoiceDetail::where('id',$key)->first();
            $product_name = Product::where('id',$invoice_details->product_id)->first();
            if($product_name->quantity < $request->selling_qty[$key]){
                return redirect()->back()->with('error','Sorry! You approve maximum value');
            }
        }
        $invoice = Invoice::find($id);
        $invoice->approved_by = Auth::user()->id;
        $invoice->status = '1';
        DB::transaction(function() use($request,$invoice,$id){
            foreach ($request->selling_qty as $key => $val) {
                $invoice_details = InvoiceDetail::where('id',$key)->first();
                $invoice_details->status = '1';
                $invoice_details->save();
                $product_name = Product::where('id',$invoice_details->product_id)->first();
                $product_name->free_quantity = ((float)$product_name->free_quantity)-((float)$request->free_selling_qty[$key]);
                $product_name->quantity = ((float)$product_name->quantity)-((float)$request->selling_qty[$key]);
                $product_name->save();
            }

            $customer = Customer::where('id',$request->customer_id)->first();
            $customer->total_amount = ((float)($customer->total_amount))+((float)($request->customer_total_amount));
            $customer->payment = ((float)($customer->payment))+((float)($request->customer_paid_amount));
            $customer->due = ((float)($customer->due))+((float)($request->customer_due_amount));
            $customer->save();
            $invoice->save();
        });
        return redirect()->route('invoices.invoice.view')->with('success','Invoice Successfully Added');
    }

    public function dueList(){
        $allData = Invoice::where('due_amount' ,'>', 0)->get();
        return view('backend.admin.invoice.invoice_due_list', compact('allData'));
    }

    public function invoicePdf($id){

        $data['invoice'] = Invoice::with(['customer','invoice_details.product.sellPrice'])->find($id);
        return view('backend.admin.invoice.pdf.invoice_print_pdf', $data);
        // $data['owner'] = ReportHeading::first();
        // $pdf           = PDF::loadView('backend.admin.invoice.pdf.invoice_print_pdf', $data);
        // $pdf->SetProtection(['copy', 'print'], '', 'pass');
        // return $pdf->stream('document.pdf');
    }

    public function invoiceDetails($id){
        $data['invoice'] = Invoice::with(['invoice_details','invoice_payment_details'])->find($id);
        $data['owner'] = ReportHeading::first();
        $pdf = PDF::loadView('backend.admin.invoice.pdf.invoice_details_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }


    public function invoiceEdit($id){
        $invoice = Invoice::whereId($id)->with(['invoice_details', 'invoice_payment',  'installment','customer'])->first();
        return view('backend.admin.invoice.invoice_edit', compact('invoice'));
    }

    public function invoiceUpdate(Request $request ,$id){

        $invoice = Invoice::whereId($id)->with('lastesInstallment')->first();
    	if($request->inspaidAmount < $request->paid_amount ){
            return redirect()->back()->with('error','Sorry! Paid price is Large then due price');
        }else{
            DB::transaction(function() use($request, $invoice, $id){

                if($request->interestamount > 0 || $request->paid_amount){
                    $invoice->update([
                    'intertest_amount'  => $request->interestamount?? $invoice->interest_amount,
                    'paid_amount'       => $invoice->paid_amount+=$request->paid_amount??0,
                    'grand_total'       => $invoice->grand_total+=$request->interestamount
                ]);
                }

                $payment['invoice_id']      = $invoice->id;
                $payment['customer_id']     = $request->customer_id;
                $payment['paid_status']     = $request->paid_status;
                $payment['payment_method']  = $request->payment_method;
                $payment['date']            = date('Y-m-d');

                if($request->paid_status=='full_paid'){
                    $payment['paid_amount'] = $request->estimated_amount;
                }elseif($request->paid_status=='full_due'){
                    $payment['paid_amount'] = '0';
                }elseif($request->paid_status=='partial_paid'){
                    $payment['paid_amount'] = $request->paid_amount??0;
                }

                $invoicePayment = InvoicePayment::create($payment);

                $invoice->lastesInstallment->update([
                    'paid_amount'   =>$request->paid_amount??0,
                    'paid_date'     => date('Y-m-d'),
                    'cross_days'    => $request->crossDays,
                ]);

                if (!empty($request->new_installAmount && $request->new_installmentDate)) {
                    $invoice->installment()->create([
                        'payment_id'   =>  $invoicePayment->id,
                        'customer_id'   => $request->customer_id,
                        'amount'        => $request->new_installAmount,
                        'interest'      => $request->new_installInterest,
                        'date'          => date('Y-m-d',strtotime($request->new_installmentDate)),
                    ]);
                }

            });
            return redirect()->route('invoices.invoice.due')->with('success','Invoice Successfully Updated');
        }
    }

    public function invoiceUpdateApprove(Request $request ,$id){
        $invoice_payment = InvoicePayment::where('invoice_id',$id)->first();
        if($invoice_payment->due_amount<$request->paid_amount){
            return redirect()->back()->with('error','Sorry! Paid price is Large then due price');
        }else{
            $invoice = Invoice::find($id);
            $invoice->status = '1';
            $customer = Customer::where('id',$invoice_payment->customer_id)->first();
            $invoice_payment = InvoicePayment::where('invoice_id',$id)->first();
            $invoice_payment->paid_status = $request->paid_status;

            $payment_details = new InvoicePaymentDetail();
            $payment_due_log = new InvoicePaymentDueLog();

            if($request->paid_status=='full_paid'){
                $invoice_payment->paid_amount = $invoice_payment->paid_amount+$request->due_paid_amount;
                $invoice_payment->due_amount = '0';
                $payment_details->current_paid_amount = $request->due_paid_amount;
                $payment_due_log->current_due_amount = '0';
                $customer->payment = ((float)($customer->payment))+((float)($request->due_paid_amount));
                $customer->due = ((float)($customer->due))-((float)($request->due_paid_amount));
            }elseif($request->paid_status=='partial_paid'){
                $invoice_payment->paid_amount = $invoice_payment->paid_amount+((float)($request->paid_amount));
                $invoice_payment->due_amount = $invoice_payment->due_amount-((float)($request->paid_amount));
                $payment_details->current_paid_amount = $request->paid_amount;
                $payment_due_log->current_due_amount = $invoice_payment->due_amount-$request->paid_amount;
                $customer->payment = ((float)($customer->payment))+((float)($request->paid_amount));
                $customer->due = ((float)($customer->due))-((float)($request->paid_amount));
            }

            $payment_details->date = date('Y-m-d',strtotime($request->date));
            $payment_details->invoice_id = $invoice->id;
            $payment_details->bank_name = $request->bank_name;
            $payment_details->cheque_no = $request->cheque_no;
            $payment_details->created_by = Auth::user()->id;
            $payment_details->save();

            $payment_due_log->date = date('Y-m-d',strtotime($request->date));
            $payment_due_log->invoice_id = $invoice->id;
            $payment_due_log->save();
            $invoice->save();
            $invoice_payment->save();
            $customer->save();

            InvoiceRepayment::where('id',$request->invoice_repayment_id)->delete();

            return redirect()->route('invoices.invoice.view')->with('success','Invoice Successfully Approved');
        }
    }

    public function updateReject(Request $request){
        $invoice_repayment = InvoiceRepayment::find($request->id);
        $invoice = Invoice::where('id',$invoice_repayment->invoice_id)->first();
        $invoice->status = '1';
        $invoice->save();
        $invoice_repayment->delete();
        return redirect()->route('invoices.invoice.view')->with('success','Invoice Successfully Rejected');
    }

    public function dailyInvoice(Request $request){
        $data['customers'] = Customer::all();
        return view('backend.admin.invoice.daily_invoice_report', $data);
    }

    public function dailyInvoiceHandlebar(Request $request){
        $customer_id = $request->customer_id;
        if($customer_id !=''){
            $where[] = ['customer_id',$customer_id];
        }
        $where[] = ['status','1'];
        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        $allInvoice = InvoiceDetail::whereBetween('date',[$start_date, $end_date])->where($where)->get();

        $html['tdsource']  = '';
        $total_sum = 0;
        $paid_sum = 0;
        $due_sum = 0;
        $html['tdsource'] .= '<tr>';
        $html['tdsource'] .= '<td colspan="8" class="text-center">'.'INVOICE REPORT'.date('d-m-Y',strtotime($start_date)).'-'.date('d-m-Y',strtotime($end_date)).'</td>';
        $html['tdsource'] .= '</tr>';

        $html['tdsource'] .= '<tr>';
        $html['tdsource'] .= '<td>'.'SL'.'</td>';
        $html['tdsource'] .= '<td>'.'Date'.'</td>';
        $html['tdsource'] .= '<td>'.'Memo No'.'</td>';
        $html['tdsource'] .= '<td>'.'Customer Info'.'</td>';
        $html['tdsource'] .= '<td>'.'Product'.'</td>';
        $html['tdsource'] .= '<td>'.'Qty'.'</td>';
        $html['tdsource'] .= '<td>'.'Unit Price'.'</td>';
        $html['tdsource'] .= '<td>'.'Amount'.'</td>';
        $html['tdsource'] .= '</tr>';

        foreach ($allInvoice as $key => $v) {
            $html['tdsource'] .= '<tr>';
            $html['tdsource'] .= '<td>'.($key+1).'</td>';
            $html['tdsource'] .= '<td>'.date('d-m-Y',strtotime(@$v->date)).'</td>';
            $html['tdsource'] .= '<td>'.'#' .@$v['invoice']['invoice_no'].'</td>';
            $html['tdsource'] .= '<td>'.@$v['customer']['name'].','.@$v['customer']['mobile'].','.@$v['customer']['address'].'</td>';
            $html['tdsource'] .= '<td>'.@$v['product']['name'].'</td>';
            $html['tdsource'] .= '<td>'.@$v->selling_qty.'</td>';
            $html['tdsource'] .= '<td>'.@$v->selling_price.'</td>';
            $total_amount = ($v->selling_qty*$v->selling_price);
            $html['tdsource'] .= '<td>'.@$total_amount.'</td>';
            $html['tdsource'] .= '</tr>';
            $total_sum += $total_amount;
        }
        $html['tdsource'] .= '<tr>';
        $html['tdsource'] .= '<td colspan="7" class="text-right">'.'Grand Total'.'</td>';
        $html['tdsource'] .= '<td>'.@$total_sum.'TK'.'</td>';
        $html['tdsource'] .= '</tr>';
        return response()->json(@$html);
    }

    public function dailyInvoicePdf(Request $request){
        $customer_id = $request->customer_id;
        if($customer_id !=''){
            $where[] = ['customer_id',$customer_id];
        }
        $where[] = ['status','1'];
        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        $data['start_date'] = date('Y-m-d',strtotime($request->start_date));
        $data['end_date'] = date('Y-m-d',strtotime($request->end_date));
        $data['allInvoice'] = InvoiceDetail::whereBetween('date',[$start_date, $end_date])->where($where)->get();
        $data['owner'] = ReportHeading::first();
        $pdf = PDF::loadView('backend.admin.invoice.pdf.daily_invoice_report_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

}
