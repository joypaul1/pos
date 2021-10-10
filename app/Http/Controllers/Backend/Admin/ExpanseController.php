<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\Customer;
use App\Model\ReportHeading;
use App\Model\InvoiceDetail;
use App\Model\Expanse;
use App\Model\ExpanseType;
use Session;
use PDF;
date_default_timezone_set("Asia/Dhaka");

class ExpanseController extends Controller
{
    public function index(){
    	$allData = Expanse::orderBy('id','desc')->get();
    	return view('backend.admin.expanse.expanse-view', compact('allData'));
    }

    public function add(){
        $data['expanse_types'] = ExpanseType::all();
        $data['cdate'] = date('Y-m-d');
    	return view('backend.admin.expanse.expanse-add', $data);
    }

    public function store(Request $request){
        if($request->expanse_type_id =='0' && $request->name ==null){
            return redirect()->back()->with('error','Others Expanse Type is required');
        }else{
            if($request->expanse_type_id == "0"){
                $expanse_type = new ExpanseType();
                $expanse_type->name = $request->name;
                $expanse_type->save();
                $expanse_type_id = $expanse_type->id;
            }else{
                $expanse_type_id = $request->expanse_type_id;
            }
            $data = new Expanse();
            $data->expanse_type_id = $expanse_type_id;
            $data->details = $request->details;
            $data->amount = ((float)$request->amount);
            $data->date = date('Y-m-d',strtotime($request->date));
            $data->created_by = Auth::user()->id;
            $data->status = '0';
            $img = $request->file('file');
            if ($img) {
                $imgName = md5(str_random(30) . time() . '_' . $img) . '.' . $img->getClientOriginalExtension();
                $request->file('file')->move('public/backend/expanses_files/', $imgName);
                $data['file'] = $imgName;
            }
            $data->save();
            return redirect()->route('expanses.expanse.view')->with('success','Well done! successfully inserted');
        }
    }

    public function edit($id){
        $data['editData'] = Expanse::find($id);
        $data['expanse_types'] = ExpanseType::all();
        $data['cdate'] = date('Y-m-d');
        return view('backend.admin.expanse.expanse-add', $data);
    }

    public function update(Request $request ,$id){
        if($request->expanse_type_id =='0' && $request->name ==null){
            return redirect()->back()->with('error','Others Expanse Type is required');
        }else{
            if($request->expanse_type_id == "0"){
                $expanse_type = new ExpanseType();
                $expanse_type->name = $request->name;
                $expanse_type->save();
                $expanse_type_id = $expanse_type->id;
            }else{
                $expanse_type_id = $request->expanse_type_id;
            }
            $data = Expanse::find($id);
            $data->expanse_type_id = $expanse_type_id;
            $data->details = $request->details;
            $data->amount = ((float)$request->amount);
            $data->date = date('Y-m-d',strtotime($request->date));
            $data->modified_by = Auth::user()->id;
            $img = $request->file('file');
            if ($img) {
                $imgName = md5(str_random(30) . time() . '_' . $img) . '.' . $img->getClientOriginalExtension();
                $request->file('file')->move('public/backend/expanses_files/', $imgName);
                if (file_exists('public/backend/expanses_files/' . $data->file) AND ! empty($data->file)) {
                    unlink('public/backend/expanses_files/' . $data->file);
                }
                $data['file'] = $imgName;
            }
            $data->save();
            return redirect()->route('expanses.expanse.view')->with('success','Well done! successfully updated');
        }
    }

    public function delete(Request $request){
        Expanse::where('id',$request->id)->delete();
        return redirect()->route('expanses.expanse.view');
    }

    public function approveGet($id){
        $data['editData'] = Expanse::find($id);
        $data['expanse_types'] = ExpanseType::all();
        $data['cdate'] = date('Y-m-d');
        return view('backend.admin.expanse.expanse_approve', $data);
    }

    public function approve(Request $request){
        $id = $request->id;
        $expanse = Expanse::where('id',$id)->first();
        DB::table('expanses')
                ->where('id', $id)
                ->update(['status' => 1]);
        return redirect()->route('expanses.expanse.view')->with('success','successfully approved');
    }

    public function attach($id){
        $id = Expanse::find($id);
        return view('backend.admin.expanse.expanse-attach', compact('id'));
    }

    public function dailyExpanse(Request $request){
        $data['expanse_types'] = ExpanseType::all();
        return view('backend.admin.expanse.daily-expanse-report',$data);
    }

    public function dailyExpanseHandlebar(Request $request){
        $expanse_type_id = $request->expanse_type_id;
        if($expanse_type_id !=''){
            $where[] = ['expanse_type_id',$expanse_type_id];
        }
        $where[] = ['status','1'];
        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        $allExpanse = Expanse::whereBetween('date',[$start_date, $end_date])->where($where)->get();

        $html['tdsource']  = '';
        $total_sum = 0;
        $html['tdsource'] .= '<tr>';
        $html['tdsource'] .= '<td colspan="6" class="text-center">'.'EXPANSE REPORT'.date('d-m-Y',strtotime($start_date)).'-'.date('d-m-Y',strtotime($end_date)).'</td>';
        $html['tdsource'] .= '</tr>';

        $html['tdsource'] .= '<tr>';
        $html['tdsource'] .= '<td>'.'SL'.'</td>';
        $html['tdsource'] .= '<td>'.'Date'.'</td>';
        $html['tdsource'] .= '<td>'.'Expanse Type'.'</td>';
        $html['tdsource'] .= '<td>'.'Amount'.'</td>';
        $html['tdsource'] .= '</tr>';

        foreach ($allExpanse as $key => $v) {
            $html['tdsource'] .= '<tr>';
            $html['tdsource'] .= '<td>'.($key+1).'</td>';
            $html['tdsource'] .= '<td>'.date('d-m-Y',strtotime(@$v->date)).'</td>';
            $html['tdsource'] .= '<td>'.@$v['expanse_type']['name'].'</td>';
            $html['tdsource'] .= '<td>'.@$v->amount.'</td>';
            $html['tdsource'] .= '</tr>';
            $total_sum += $v->amount;
        }
        $html['tdsource'] .= '<tr>';
        $html['tdsource'] .= '<td colspan="3" class="text-right">'.'Grand Total'.'</td>';
        $html['tdsource'] .= '<td>'.@$total_sum.'TK'.'</td>';
        $html['tdsource'] .= '</tr>';
        return response()->json(@$html);
    }

    public function dailyExpansePdf(Request $request){
        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        $expanse_type_id = $request->expanse_type_id;
        if($expanse_type_id !=''){
            $where[] = ['expanse_type_id',$expanse_type_id];
        }
        $where[] = ['status','1'];
        $data['start_date'] = date('Y-m-d',strtotime($request->start_date));
        $data['end_date'] = date('Y-m-d',strtotime($request->end_date));
        $data['allExpanse'] = Expanse::whereBetween('date',[$start_date, $end_date])->where($where)->get();
        $data['owner'] = ReportHeading::first();
        $pdf = PDF::loadView('backend.admin.expanse.daily-expanse-report-pdf', $data);
        // $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
