<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\Supplier;
use App\Model\PurchasePayment;
use App\Model\PurchasePaymentDetail;
use App\Model\ReportHeading;
use PDF;

class SupplierController extends Controller
{
    public function index(){
    	$allData = Supplier::where('status','1')->orderBy('id','desc')->get();
    	return view('backend.admin.supplier.supplier-view', compact('allData'));
    }

    public function add(){
    	return view('backend.admin.supplier.supplier-add');
    }

    public function store(Request $request){
        $data = new Supplier();
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->created_by = Auth::user()->id;
        $data->save();
        return redirect()->route('suppliers.supplier.view')->with('success','Well done! successfully inserted');
    }

    public function edit($id){
        $data['editData'] = Supplier::find($id);
        return view('backend.admin.supplier.supplier-add', $data);
    }

    public function update(Request $request ,$id){
        $data = Supplier::find($id);
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->modified_by = Auth::user()->id;
        $data->save();
        return redirect()->route('suppliers.supplier.view')->with('success','Well done! successfully update');
    }

    public function details($id){
        // dd('ok');
        $purchase = PurchasePayment::select('purchase_id')->where('supplier_id',$id)->groupBy('purchase_id')->get()->toArray();
        $data['supplier_info'] = Supplier::where('id',$id)->first();
        $data['puchase_details'] = PurchasePaymentDetail::where('purchase_id',$purchase)->get();
        $data['owner'] = ReportHeading::first();
        $pdf = PDF::loadView('backend.admin.supplier.pdf.supplier_details_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function report()
    {
        $data['suppliers'] = Supplier::all();
        return view('backend.admin.supplier.supplier_report', $data);
    }

    public function reportHandlebar(Request $request){
        $supplier_id = $request->supplier_id;
        if($supplier_id !=''){
            $where[] = ['id',$supplier_id];
        }
        $data = Supplier::where($where)->get();
        $html['thsource'] = '<th width="5%">Sl.</th>';
        $html['thsource'] .= '<th>Supplier Info</th>';
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
        $supplier_id = $request->supplier_id;
        if($supplier_id !=''){
            $where[] = ['id',$supplier_id];
        }
        $data['suppliers'] = Supplier::where($where)->get();
        $data['owner'] = ReportHeading::first();
        $pdf = PDF::loadView('backend.admin.supplier.pdf.supplier_report_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function destroy(Request $request){
        $id = $request->id;
        DB::table('products')
                ->where('id', $id)
                ->update(['status' => 0]);
        return redirect()->route('suppliers.supplier.view');
    }
    
}
