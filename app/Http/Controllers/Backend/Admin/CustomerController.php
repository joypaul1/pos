<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\ReportHeading;
use App\Model\Customer;
use App\Model\Invoice;
use App\Model\InvoiceDetail;
use App\Model\InvoicePayment;
use App\Model\InvoicePaymentDetail;
use App\Model\InvoicePaymentDueLog;
use Session;
use PDF;

class CustomerController extends Controller
{
    public function index(){
    	$allData = Customer::where('status','1')->orderBy('id','desc')->get();
    	return view('backend.admin.customer.customer-view', compact('allData'));
    }

    public function add(){
    	return view('backend.admin.customer.customer-add');
    }

    public function store(Request $request){
        $data = new Customer();
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->created_by = Auth::user()->id;
        $data->save();
        return redirect()->route('customers.customer.view')->with('success','Well done! successfully inserted');
    }

    public function edit($id){
        $data['editData'] = Customer::find($id);
        return view('backend.admin.customer.customer-add', $data);
    }

    public function update(Request $request ,$id){
        $data = Customer::find($id);
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->modified_by = Auth::user()->id;
        $data->save();
        return redirect()->route('customers.customer.view')->with('success','Well done! successfully update');
    }

    public function details(Request $request){
        $invoice = InvoicePayment::select('invoice_id')->where('customer_id',$request->customer_id)->groupBy('invoice_id')->get()->toArray();
        $data['customer_info'] = Customer::where('id',$request->customer_id)->first();
        // $data['payment_details'] = InvoicePaymentDetail::whereIn('invoice_id',$invoice)->get();
        // dd($data['payment_details']->toArray());
        $data['payment_details'] =[];
        $data['owner'] = ReportHeading::first();
        // return view('backend.admin.customer.pdf.customer_details_pdf', $data);
        $pdf = PDF::loadView('backend.admin.customer.pdf.customer_details_pdf', $data);
        // $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function report(){
        $data['customers'] = Customer::all();
        return view('backend.admin.customer.customer_report', $data);
    }

    public function reportHandlebar(Request $request){
        $customer_id = $request->customer_id;
        if($customer_id !=''){
            $where[] = ['id',$customer_id];
        }
        $where[] = ['status','1'];
        $data = Customer::where($where)->get();
        $html['thsource'] = '<th width="5%">Sl.</th>';
        $html['thsource'] .= '<th>Customer Info</th>';
        $html['thsource'] .= '<th>Total Amount</th>';
        $html['thsource'] .= '<th>Paid Amount</th>';
        $html['thsource'] .= '<th>Due Amount</th>';
        $html['tdsource']  = '';
        $total_sum = 0;
        $paid_sum = 0;
        $due_sum = 0;
        foreach ($data as $key => $v) {
            $html['tdsource'] .= '<tr>';
            $html['tdsource'] .= '<td>'.($key+1).'</td>';
            $html['tdsource'] .= '<td>'.@$v->name.','.@$v->mobile.','.@$v->address.'</td>';
            $html['tdsource'] .= '<td>'.@$v->total_amount.'</td>';
            $html['tdsource'] .= '<td>'.@$v->payment.'</td>';
            $html['tdsource'] .= '<td>'.@$v->due.'</td>';
            $html['tdsource'] .= '</tr>';
            $total_sum += $v->total_amount;
            $paid_sum += $v->payment;
            $due_sum += $v->due;
        }
        $html['tdsource'] .= '<tr>';
        $html['tdsource'] .= '<td colspan="2" class="text-right">'.'Grand Total'.'</td>';
        $html['tdsource'] .= '<td>'.@$total_sum.'TK'.'</td>';
        $html['tdsource'] .= '<td>'.@$paid_sum.'TK'.'</td>';
        $html['tdsource'] .= '<td>'.@$due_sum.'TK'.'</td>';
        $html['tdsource'] .= '</tr>';
        return response()->json(@$html);
    }

    public function reportPdf(Request $request)
    {
        $customer_id = $request->customer_id;
        if($customer_id !=''){
            $where[] = ['id',$customer_id];
        }
        $where[] = ['status','1'];
        $data['allData'] = Customer::where($where)->get();
        $data['owner'] = ReportHeading::first();
        $pdf = PDF::loadView('backend.admin.customer.pdf.customer_report_pdf', $data);
        // $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function creditPaidReport(){
        $data['customers'] = Customer::all();
        return view('backend.admin.customer.credit_paid_customer_report', $data);
    }

    public function creditPaidHandlebar(Request $request){
        $customer_id = $request->customer_id;
        if($customer_id !=''){
            $where[] = ['customer_id',$customer_id];
        }
        $where[] = ['status','1'];
        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        $report_status = $request->report_status;
        if($start_date !='' && $end_date !='' && $request->report_status == 'credit_customer'){
            $allInvoice = Invoice::whereBetween('date',[$start_date, $end_date])
            ->where($where)->where('grand_total', '>', 'paid_amount')->get();
        }if($start_date !='' && $end_date !='' && $request->report_status == 'paid_customer') {
            $allInvoice = Invoice::whereBetween('date',[$start_date, $end_date])
            ->where($where)->where('grand_total', '=', 'paid_amount')->get();
        }

        $html['tdsource']  = '';
        $total_sum = 0;
        $paid_sum = 0;
        $due_sum = 0;
        $html['tdsource'] .= '<tr>';
        if($report_status=='credit_customer'){
            if($start_date && $end_date){
                $html['tdsource'] .= '<td colspan="5" class="text-center">'.'CREDIT REPORT'.date('d-m-Y',strtotime($start_date)).'-'.date('d-m-Y',strtotime($end_date)).'</td>';
            }
        }elseif ($report_status=='paid_customer') {
            if($start_date && $end_date){
                $html['tdsource'] .= '<td colspan="5" class="text-center">'.'PAID REPORT'.date('d-m-Y',strtotime($start_date)).'-'.date('d-m-Y',strtotime($end_date)).'</td>';
            }
        }
        $html['tdsource'] .= '</tr>';

        $html['tdsource'] .= '<tr>';
        $html['tdsource'] .= '<td>'.'SL'.'</td>';
        $html['tdsource'] .= '<td>'.'Customer Info'.'</td>';
        $html['tdsource'] .= '<td>'.'Invoice No'.'</td>';
        $html['tdsource'] .= '<td>'.'Total Amount'.'</td>';
        $html['tdsource'] .= '<td>'.'Paid Amount'.'</td>';
        $html['tdsource'] .= '<td>'.'Due Amount'.'</td>';
        $html['tdsource'] .= '</tr>';

        foreach ($allInvoice as $key => $v) {
            $html['tdsource'] .= '<tr>';
            $html['tdsource'] .= '<td>'.($key+1).'</td>';
            $html['tdsource'] .= '<td>'.'#'.@$v['invoice_no'].'</td>';
            $html['tdsource'] .= '<td>'.@$v['customer']['name'].','.@$v['customer']['mobile'].','.@$v['customer']['address'].'</td>';
            $html['tdsource'] .= '<td>'.@$v->total_amount.'</td>';
            $html['tdsource'] .= '<td>'.@$v->paid_amount.'</td>';
            $html['tdsource'] .= '<td>'.@$v->due_amount.'</td>';
            $html['tdsource'] .= '</tr>';
            $total_sum += $v->total_amount;
            $paid_sum += $v->paid_amount;
            $due_sum += $v->due_amount;
        }
        $html['tdsource'] .= '<tr>';
        $html['tdsource'] .= '<td colspan="3" class="text-right">'.'Grand Total'.'</td>';
        $html['tdsource'] .= '<td>'.@$total_sum.'TK'.'</td>';
        $html['tdsource'] .= '<td>'.@$paid_sum.'TK'.'</td>';
        $html['tdsource'] .= '<td>'.@$due_sum.'TK'.'</td>';
        $html['tdsource'] .= '</tr>';
        return response()->json(@$html);
    }

    public function creditPaidPdf(Request $request)
    {
        $customer_id = $request->customer_id;
        if($customer_id !=''){
            $where[] = ['customer_id',$customer_id];
        }
        $where[] = ['status','1'];
        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        $data['start_date'] = date('Y-m-d',strtotime($request->start_date));
        $data['end_date'] = date('Y-m-d',strtotime($request->end_date));
        $data['report_status'] = $request->report_status;
        if($start_date !='' && $end_date !='' && $request->report_status == 'credit_customer'){
        //    $data['allInvoice'] = InvoicePayment::whereBetween('date',[$start_date, $end_date])->whereIn('paid_status',['full_due','partial_paid'])->where($where)->get();
        $data['allInvoice'] = Invoice::whereBetween('date',[$start_date, $end_date])
        ->where($where)->where('grand_total', '>', 'paid_amount')->get();
        }if($start_date !='' && $end_date !='' && $request->report_status == 'paid_customer') {
        //    $data['allInvoice'] = InvoicePayment::whereBetween('date',[$start_date, $end_date])->where('paid_status','!=','full_due')->where($where)->get();
        $data['allInvoice'] = Invoice::whereBetween('date',[$start_date, $end_date])
        ->where($where)->where('grand_total', '=', 'paid_amount')->get();
        }
        $data['owner'] = ReportHeading::first();


        $pdf = PDF::loadView('backend.admin.customer.pdf.customer_credit_paid_report_pdf', $data);
        // $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream("Customer-credit/paid-report->" .date('d-m-Y'));
    }

    public function destroy(Request $request){
        $id = $request->id;
        DB::table('products')
                ->where('id', $id)
                ->update(['status' => 0]);
        return redirect()->route('customers.customer.view');
    }
}
