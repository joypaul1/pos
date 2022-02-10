<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\ReportHeading;
use App\Model\Unit;
use App\Model\Category;
use App\Model\Customer;
use App\Model\Supplier;
use App\Model\Product;
use App\Model\Purchase;
use App\Model\PurchaseDetail;
use App\Model\PurchasePayment;
use App\Model\PurchasePaymentDetail;
use App\Model\PurchaseRepayment;
use App\Model\Invoice;
use App\Model\InvoiceDetail;
use App\Model\InvoicePayment;
use App\Model\InvoicePaymentDetail;
use App\Model\InvoicePaymentDueLog;
use App\Model\InvoiceRepayment;
use App\Model\Expanse;
use App\Model\ExpanseType;
use Session;
use PDF;
date_default_timezone_set("Asia/Dhaka");

class ReportController extends Controller
{
    public function viewReport(){
        return view('backend.admin.profit.profit_report');
    }

    public function reportHandlebar(Request $request){
        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date   = date('Y-m-d',strtotime($request->end_date));
        $sales      = Invoice::whereBetween('date',[$start_date, $end_date])->sum('grand_total');
        $discount      = Invoice::whereBetween('date',[$start_date, $end_date])->sum('discount_amount');
        $purchase   = PurchasePaymentDetail::whereBetween('date',[$start_date, $end_date])->sum('current_paid_amount');
        $expanse    = Expanse::whereBetween('date',[$start_date, $end_date])->sum('amount');
        $cost       = $purchase + $expanse + $discount;
        $profit     = $sales-$cost;

        $html['tdsource']  = '';
        $html['tdsource'] .= '<tr>';
        $html['tdsource'] .= '<td colspan="5" class="text-center">'.'PROFIT REPORT '.date('d-m-Y',strtotime($start_date)).'-'.date('d-m-Y',strtotime($end_date)).'</td>';
        $html['tdsource'] .= '</tr>';

        $html['tdsource'] .= '<tr>';
        $html['tdsource'] .= '<td>'.'Sales'.'</td>';
        $html['tdsource'] .= '<td>'.'Purchase'.'</td>';
        $html['tdsource'] .= '<td>'.'Expanse'.'</td>';
        $html['tdsource'] .= '<td>'.'Discount'.'</td>';
        $html['tdsource'] .= '<td>'.'Total Cost'.'</td>';
        $html['tdsource'] .= '<td>'.'Profit'.'</td>';
        $html['tdsource'] .= '</tr>';

        $html['tdsource'] .= '<tr>';
        $html['tdsource'] .= '<td>'.$sales.'</td>';
        $html['tdsource'] .= '<td>'.$purchase.'</td>';
        $html['tdsource'] .= '<td>'.$expanse.'</td>';
        $html['tdsource'] .= '<td>'.$discount.'</td>';
        $html['tdsource'] .= '<td>'.$cost.'</td>';
        $html['tdsource'] .= '<td>'.$profit.'</td>';
        $html['tdsource'] .= '</tr>';
        return response()->json(@$html);
    }

    public function reportPdf(Request $request)
    {

        // $data['sales'] = InvoicePaymentDetail::whereBetween('date',[$start_date, $end_date])->sum('current_paid_amount');
        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        $data['sales'] = Invoice::whereBetween('date',[$start_date, $end_date])->sum('grand_total');
        $data['purchase'] = PurchasePaymentDetail::whereBetween('date',[$start_date, $end_date])->sum('current_paid_amount');
        $data['expanse'] = Expanse::whereBetween('date',[$start_date, $end_date])->sum('amount');
        $data['cost'] = $data['purchase']+$data['expanse'];
        $data['profit'] = $data['sales']-$data['cost'];
        $data['start_date'] = date('d-m-Y',strtotime($request->start_date));
        $data['end_date'] = date('d-m-Y',strtotime($request->end_date));
        $data['allInvoice'] = Invoice::whereBetween('date',[$start_date, $end_date])->get();
        $data['allPurchase'] = PurchasePaymentDetail::whereBetween('date',[$start_date, $end_date])->get();
        $data['allExpanse'] = Expanse::whereBetween('date',[$start_date, $end_date])->get();
        $data['owner'] = ReportHeading::first();
        // return view('backend.admin.profit.pdf.profit_pdf', $data);
        $pdf = PDF::loadView('backend.admin.profit.pdf.profit_pdf', $data);
        // $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('profit_pdf'. date('d-m-Y'));
    }
}
