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
        $total_due = $dues->due??0;
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

            $invoice['service_charge']   = $request->service_charge;
            $invoice['discount_amount']   = $request->discount_amount;
            $invoice['grand_total']   = $request->estimated_amount;
            $invoice['total_amount']  = $request->estimated_amount+$invoice['discount_amount']-$request->service_charge;
            $invoice['invoice_no']    = $invoice_no;
            $invoice['date']          = date('Y-m-d',strtotime($request->date));
            $invoice['description']   = $request->description??' ';
            $invoice['customer_id']   = $request->customer_id;
            if($request->paid_status == "full_paid"){
                $invoice['paid_amount']   = $request->estimated_amount??0;
            }else{
                $invoice['paid_amount']   = $request->paid_amount??0;
            }

            try {
                DB::transaction(function() use($request, $invoice){

                        $customer = Customer::whereId($request->customer_id)->first();

                        $invoice = Invoice::create($invoice);
                        if($request->category_id !=null){
                            for ($i=0; $i < count($request->category_id) ; $i++) {
                                $invoice_details['invoice_id']    = $invoice->id;
                                $invoice_details['customer_id']   = $request->customer_id;
                                $invoice_details['date']          = date('Y-m-d',strtotime($request->date));
                                $invoice_details['category_id']   = $request->category_id[$i];
                                $invoice_details['product_id']    = $request->product_id[$i];
                                $invoice_details['chasiss_no']   = $request->chasiss_no[$i];
                                $invoice_details['engine_no']   = $request->engine_no[$i];
                                $invoice_details['color']   =       $request->color[$i];
                                $invoice_details['year_of_manufacture']   =       $request->input('Y/O/M')[$i];

                                $invoice_details['selling_qty']   = $request->selling_qty[$i];
                                $invoice_details['selling_price'] = $request->selling_price[$i];
                                $invoice_details['unit_price']    = $request->unit_price[$i];
                                $invoice_details['actual_total_price'] = $request->unit_price[$i] *$request->selling_qty[$i] ;
                                $invoice_details['total_price'] = $request->selling_price[$i] *$request->selling_qty[$i] ;
                                if ($request->free_selling_qty) {
                                    $invoice_details['free_selling_qty'] = $request->free_selling_qty[$i];
                                }else{
                                    $invoice_details['free_selling_qty'] = '0';
                                }
                                if ($request->serial_no) {
                                    $invoice_details['serial_no'] = $request->serial_no[$i];
                                }else{
                                    $invoice_details['serial_no'] = '0';
                                }
                                if ($request->warranty) {
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
                                $customer->update([
                                    'total_amount' =>  $customer->total_amount+$request->estimated_amount,
                                    'payment' =>  $customer->payment+$request->estimated_amount,
                                ]);
                            }else{
                                $payment['paid_amount'] = $request->paid_amount??0;
                                $customer->update([
                                    'total_amount' =>  $customer->total_amount+$request->estimated_amount,
                                    'due' =>  $customer->due+=($request->estimated_amount- $request->paid_amount),
                                    'payment' =>  $customer->payment+$request->paid_amount,
                                ]);
                            }

                            $invoicePayment = InvoicePayment::create($payment);

                            if (!empty($request->installmentDate && $request->installAmount)) {
                                $interest=  number_format($request->installInterest/30, 2);
                                $invoice->installment()->create([
                                    'payment_id'   =>  $invoicePayment->id,
                                    'customer_id'   => $request->customer_id,
                                    'amount'        => $request->installAmount,
                                    'interest'      => $interest,
                                    'date'          => date('Y-m-d',strtotime($request->installmentDate)),
                                ]);
                                // dd( $v);
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
        $customer = Customer::whereId($invoice->customer_id)->first();
        $customer->update([
            'total_amount'  =>  $customer->total_amount-$invoice->grand_total,
            'due'           =>  $customer->due-$invoice->due_amount??0,
            'payment'       =>  $customer->payment-$invoice->paid_amount,
        ]);
        $invoice->delete();

        return redirect()->route('invoices.invoice.view');
    }

    public function invoiceApprove($id){

        Invoice::whereId($id)->update(['status' => 1]);
        return redirect()->route('invoices.invoice.view')->with('success','Invoice Successfully Approved');

    }



    public function dueList(){

        $allData = Invoice::where('due_amount' ,'>', 0)->get();
        return view('backend.admin.invoice.invoice_due_list', compact('allData'));
    }


//amar add kora

    public function invoicePdfa($id){
        $data['owner'] = ReportHeading::first();
        $data['invoice'] = Invoice::with(['customer','invoice_details.product.sellPrice'])->find($id);
        return view('backend.admin.invoice.pdf.invoice_print_pdfa', $data);

    }


    //amar add kora
    public function invoicePdf($id){

        $data['owner'] = ReportHeading::first();
        $data['invoice'] = Invoice::with(['customer','invoice_details.product.sellPrice'])->find($id);
        return view('backend.admin.invoice.pdf.invoice_print_pdf', $data);

    }
    public function othersPdf($id){
        $data['owner'] = ReportHeading::first();
        $data['invoice'] = Invoice::with(['customer','installment','invoice_detail.product.sellPrice'])->find($id);
        return view('backend.admin.invoice.pdf.invoice_print_othersPdf', $data);

    }
    public function bankpdf($id){

        $data['owner'] = ReportHeading::first();
        $data['invoice'] = Invoice::with(['customer','invoice_details.product.sellPrice'])->find($id);

        return view('backend.admin.invoice.pdf.bank_pdf', $data);

    }

    public function invoiceDetails($id){
         $data['invoice'] = Invoice::with(['invoice_details','invoice_payment_details'])->find($id);
        $data['owner'] = ReportHeading::first();
        $pdf = PDF::loadView('backend.admin.invoice.pdf.invoice_details_pdf', $data);

        return $pdf->stream('document.pdf');
    }


    public function invoiceEdit($id){
        $invoice = Invoice::whereId($id)->with(['invoice_details', 'invoice_payment',  'installment','customer'])->first();
        return view('backend.admin.invoice.invoice_edit', compact('invoice'));
    }

    public function invoiceUpdate(Request $request ,$id){

        // dd($request->all());
        $invoice = Invoice::whereId($id)->with('lastesInstallment')->first();
    	if($request->inspaidAmount < $request->paid_amount ){
            return redirect()->back()->with('error','Sorry! Paid price is Large then due price');
        }else{
            try {
                DB::transaction(function() use($request, $invoice, $id){
                    $customer = Customer::whereId($request->customer_id)->first();

                    $payment['invoice_id']      = $invoice->id;
                    $payment['customer_id']     = $request->customer_id;
                    $payment['paid_status']     = $request->paid_status;
                    $payment['payment_method']  = $request->payment_method;
                    $payment['date']            = date('Y-m-d');
                    // dd($payment);
                    if($request->paid_status=='full_paid'){

                    $invoice->update([
                            'intertest_amount'  => $request->interestamount + $invoice->interest_amount,
                            'paid_amount'       => $invoice->paid_amount + $request->inspaidAmount??0,
                            'grand_total'       => $invoice->grand_total + $request->interestamount,

                            ]);

                        $payment['paid_amount'] = $request->estimated_amount;
                        $customer->update([
                            'total_amount'  =>  $customer->total_amount + $request->interestamount,
                            'due'           =>  $customer->due - $request->due ??0,
                            'payment'       =>  $customer->payment+$request->inspaidAmount,
                        ]);

                    }elseif($request->paid_status=='partial_paid'){
                        // dd( $customer);
                        $payment['paid_amount'] = $request->paid_amount??0;
                        $customer->update([
                            'total_amount'  =>  $customer->total_amount+$request->interestamount,
                            'due'           =>  $customer->due+$request->interestamount-$request->paid_amount - $request->dis_cls ??0,
                            'payment'       =>  $customer->payment+$request->paid_amount,
                        ]);

                        $invoice->update([
                            'intertest_amount'  => $request->interestamount+$invoice->interest_amount,
                            'paid_amount'       => $invoice->paid_amount+$request->paid_amount??0,
                            'grand_total'       => $invoice->grand_total+$request->interestamount,
                            'discount_amount'   => $invoice->discount_amount + $request->dis_cls,
                            'installment_discount_amount'   => $invoice->installment_discount_amount + $request->dis_cls
                        ]);
                        // dd($invoice);

                    }


                    $invoicePayment = InvoicePayment::create($payment);

                    $invoice->lastesInstallment->update([
                        'paid_amount'   =>$request->paid_amount??0,
                        'paid_date'     => date('Y-m-d'),
                        'cross_days'    => $request->crossDays,
                    ]);

                    if (!empty($request->new_installAmount && $request->new_installmentDate)) {

                        $interest=  number_format($request->new_installInterest/30, 2);

                        $invoice->installment()->create([
                            'payment_id'   =>  $invoicePayment->id,
                            'customer_id'   => $request->customer_id,
                            'amount'        => $request->new_installAmount,
                            'interest'      => $interest,
                            'date'          => date('Y-m-d',strtotime($request->new_installmentDate)),
                        ]);

                    }

                });
            } catch (\Exception $ex) {
                dd($ex->getMessage(), $ex->getLine());
            }
            return redirect()->to('invoices/view')->with('success','Invoice Successfully Updated');
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

        $allInvoice = Invoice::whereBetween('date',[$start_date, $end_date])
                                ->withCount([
                                    'invoice_details AS selling_qty' => function ($query) {
                                                $query->select(DB::raw("SUM(selling_qty)"));
                                            }
                                        ])
                                ->withCount([
                                    'invoice_details AS unit_price' => function ($query) {
                                                $query->select(DB::raw("SUM(unit_price)"));
                                            }
                                        ])

                                ->withCount([
                                    'invoice_details AS product_qty' => function ($query) {
                                                $query->select(DB::raw("COUNT(product_id)"));
                                            }
                                        ])
                                ->withCount([
                                    'invoice_details AS total_price' => function ($query) {
                                                $query->select(DB::raw("SUM(total_price)"));
                                            }
                                        ])
                                ->get();
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
        $html['tdsource'] .= '<td>'.'Unit Price/1'.'</td>';
        $html['tdsource'] .= '<td>'.'Qty'.'</td>';
        $html['tdsource'] .= '<td>'.'Amount'.'</td>';
        $html['tdsource'] .= '<td>'.'Intertest'.'</td>';
        $html['tdsource'] .= '<td>'.'Grand Total'.'</td>';
        $html['tdsource'] .= '</tr>';

        foreach ($allInvoice as $key => $v) {
            $html['tdsource'] .= '<tr>';
            $html['tdsource'] .= '<td>'.($key+1).'</td>';
            $html['tdsource'] .= '<td>'.date('d-m-Y',strtotime(@$v->date)).'</td>';
            $html['tdsource'] .= '<td>'.'#' .@$v['invoice_no'].'</td>';
            $html['tdsource'] .= '<td>'.@$v['customer']['name'].','.@$v['customer']['mobile'].','.@$v['customer']['address'].'</td>';
            $html['tdsource'] .= '<td>'.@$v->unit_price.'</td>';
            $html['tdsource'] .= '<td>'.@$v->selling_qty.'</td>';
            $html['tdsource'] .= '<td>'.@$v->total_amount.'</td>';
            $html['tdsource'] .= '<td>'.@$v->intertest_amount.'</td>';
            $html['tdsource'] .= '<td>'.@$v->grand_total.'</td>';
            $html['tdsource'] .= '</tr>';
            $total_sum += $v->grand_total;
        }
        $html['tdsource'] .= '<tr>';
        $html['tdsource'] .= '<td colspan="8" class="text-right">'.'Grand Total'.'</td>';
        $html['tdsource'] .= '<td>'.@$total_sum.'TK'.'</td>';
        $html['tdsource'] .= '</tr>';
        return response()->json(@$html);
    }

    public function dailyInvoicePdf(Request $request){

        $data['start_date'] = date('Y-m-d',strtotime($request->start_date));
        $data['end_date']   = date('Y-m-d',strtotime($request->end_date));
        $data['invoice']  =  Invoice::whereBetween('date',[$data['start_date'], $data['end_date']])
                                ->withCount([
                                    'invoice_details AS selling_qty' => function ($query) {
                                                $query->select(DB::raw("SUM(selling_qty)"));
                                            }
                                        ])
                                ->withCount([
                                    'invoice_details AS unit_price' => function ($query) {
                                                $query->select(DB::raw("SUM(unit_price)"));
                                            }
                                        ])
                                ->withCount([
                                    'invoice_details AS product_qty' => function ($query) {
                                                $query->select(DB::raw("COUNT(product_id)"));
                                            }
                                        ])
                                ->withCount([
                                    'invoice_details AS total_price' => function ($query) {
                                                $query->select(DB::raw("SUM(total_price)"));
                                            }
                                        ])
                                ->get();

        return view('backend.admin.invoice.pdf.daily_invoice_report_pdf',[ 'data' =>  $data]);
        $pdf = PDF::loadView('backend.admin.invoice.pdf.daily_invoice_report_pdf',[ 'data' =>  $data]);
        // $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream("Daily-invoice-report->" .date('d-m-Y'));
        // $customer_id = $request->customer_id;
        // if($customer_id !=''){
        //     $where[] = ['customer_id',$customer_id];
        // }
        // $where[] = ['status','1'];

        // $data['start_date'] = date('Y-m-d',strtotime($request->start_date));
        // $data['end_date'] = date('Y-m-d',strtotime($request->end_date));
        // $data['allInvoice'] = InvoiceDetail::whereBetween('date',[$start_date, $end_date])->where($where)->get();
        // $data['owner'] = ReportHeading::first();
        // $pdf = PDF::loadView;
        // $pdf->SetProtection(['copy', 'print'], '', 'pass');
        // return $pdf->stream('document.pdf');
    }

}
