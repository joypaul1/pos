@extends('backend.layouts.master')
@section('content')
<style type="text/css">
	tr th{
		padding: 3px;
	}
	tr td{
		padding: 1px 3px 1px 3px;
	}
</style>
<div class="content-page">
    
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
						<h2 class="main-title float-left">Manage Purchase</h2>
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item">Home</li>
							<li class="breadcrumb-item">Purchase</li>
						</ol>
						<div class="clearfix"></div>
					</div>
                </div>
            </div>
            <!-- end row -->
            
            <div class="container fullbody">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h5>Purchase Approval (Purchase No:#{{$purchase->purchase_no}}) Date: {{date('d-m-Y',strtotime($purchase->date))}}
								<a class="btn btn-sm btn-success float-right" href="{{route('purchases.purchase.view')}}"><i class="fa fa-list"></i> Purchase List</a>
							</h5>
						</div>
						<form method="post" action="{{route('purchases.purchase.update-approval.store',$purchase->id)}}" id="myForm">
							@csrf
							<div class="card-body">
								@php
						      		$purchase_repayment = App\Model\PurchaseRepayment::where('purchase_id',$purchase->id)->first();
						      		$purchase_payment = App\Model\PurchasePayment::where('purchase_id',$purchase->id)->first();
						      		$purchase_payment_details = App\Model\PurchasePaymentDetail::where('purchase_id',$purchase->id)->first();
						      	@endphp
								<table width="100%">
						        	<tbody>
						        		<tr>
						        			<td width="15%">
						        				<p style="font-size: 16px;font-weight: bold;">Supplier Info:</p>
						        			</td>
						        			<td width="25%">
						        				<p style="font-size: 14px;border-bottom: 1px dotted #000;width: 100%">Name : {{$purchase_repayment['supplier']['name']}}</p>
						        			</td>
						        			<td width="30%">
						        				<p style="font-size: 14px;border-bottom: 1px dotted #000;width: 100%">Mobile : {{$purchase_repayment['supplier']['mobile']}}</p>
						        			</td>
						        			<td width="30%">
						        				<p style="font-size: 14px;border-bottom: 1px dotted #000;width: 100%">Address : {{$purchase_repayment['supplier']['address']}}</p>
						        			</td>
						        		</tr>
						        		<tr>
						        			<td width="15%"></td>
						        			<td colspan="2" width="85%">
						        				<p>Description: {{$purchase->description}}</p>
						        			</td>
						        		</tr>
						        	</tbody>
						        </table>
						        <table border="1" style="margin-bottom: 5px;">
						          <thead>
						            <tr>
						              <th>SL</th>
						              <th>Category</th>
						              <th>Product Name</th>
						              <th>Pcs/Kg</th>
						              <th width="15%">Rate</th>
						              <th width="22%">Price</th>
						            </tr>
						          </thead>
						          <tbody>
						          	@php
						          		$product_sale_sum = 0;
						          	@endphp
						          	@foreach($purchase['purchase_details'] as $key => $details)
						            <tr>
						            	<td>{{$key+1}}</td>
						            	<td>{{$details['category']['name']}}</td>
						            	<td>{{$details['product']['name']}}</td>
						            	<td width="5%">{{$details->buying_qty}}</td>
						            	<td>{{$details->unit_price}} TK</td>
						            	<td>{{$details->buying_price}} TK</td>
						            	@php
						            		$product_sale_sum += $details->buying_price;
						            	@endphp
						            </tr>
						            @endforeach
						            <tr>
						            	<td colspan="4" rowspan="7"></td>
						            	<td><p style="font-weight: bold;">Total</p></td>
						            	<td><p style="font-weight: bold;">{{$product_sale_sum}} TK</p></td>
						            </tr>
						            <tr>
						            	<td><p style="font-weight: bold;">Already Paid</p></td>
						            	<td><p style="font-weight: bold;">{{$purchase_payment->paid_amount}} TK</p></td>
						            </tr>
						            <tr>
						            	@php
						            		if($purchase_repayment->paid_status=='full_paid'){
							            		$due_amount = '0';
						            		}else{
							            		$due_amount = $purchase_payment->due_amount-$purchase_repayment->paid_amount;
						            		}
						            	@endphp
						            	<td><p style="font-weight: bold;">Current Paid</p></td>
						            	<td><p style="font-weight: bold;">
						            		@if($purchase_repayment->paid_status=='full_paid')
						            		{{$purchase_payment->due_amount}}
						            		@elseif($purchase_repayment->paid_status=='partial_paid')
						            		{{$purchase_repayment->paid_amount}} TK
						            		@endif
						            	</p></td>
						            </tr>
						            <tr>
						            	<td><p style="font-weight: bold;">Due</p></td>
						            	<td><p style="font-weight: bold;">{{round($due_amount, 2)}} TK</p></td>
						            </tr>
						            <tr>
						            	<td><p style="font-weight: bold;">Payment Method</p></td>
						            	<td><p style="font-weight: bold;">{{$purchase_repayment->payment_method}}</p></td>
						            </tr>
						            @if($purchase_repayment->payment_method=='Cheque')
						            <tr>
						            	<td><p style="font-weight: bold;">Bank & Cheque No</p></td>
						            	<td><p style="font-weight: bold;">{{$purchase_repayment->bank_name}} - ({{$purchase_repayment->cheque_no}})</p></td>
						            </tr>
						            @endif
									<input type="hidden" name="supplier_id" value="{{$purchase_repayment->supplier_id}}">
						            <input type="hidden" name="new_paid_amount" value="{{$purchase_repayment->new_paid_amount}}">
						            <input type="hidden" name="date" value="{{$purchase_repayment->date}}">
						            <input type="hidden" name="payment_method" value="{{$purchase_repayment->payment_method}}">
						            <input type="hidden" name="paid_status" value="{{$purchase_repayment->paid_status}}">
						            <input type="hidden" name="paid_amount" value="{{$purchase_repayment->paid_amount}}">
						            <input type="hidden" name="bank_name" value="{{$purchase_repayment->bank_name}}">
						            <input type="hidden" name="cheque_no" value="{{$purchase_repayment->cheque_no}}">
					            	<input type="hidden" name="supplier_paid_amount" value="{{$purchase_repayment->paid_amount}}">
					            	<input type="hidden" name="purchase_repayment_id" value="{{$purchase_repayment->id}}">
						          </tbody>
						        </table><br/>
								<button type="submit" class="btn btn-primary">Purchase Approve</button>
								<a href="{{route('purchases.purchase.reject').'?id='.$purchase_repayment->id}}" data-id="{{$purchase_repayment->id}}" class="btn btn-danger pull-right">Purchase Reject</a>
							</div>
						</form>
					</div>
				</div>
			</div>

        </div>
        <!-- END container-fluid -->

    </div>
    <!-- END content -->

</div>
<!-- END content-page -->

@endsection