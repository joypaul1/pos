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
						<h2 class="main-title float-left">Manage Invoice</h2>
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item">Home</li>
							<li class="breadcrumb-item">Invoice</li>
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
							<h5>Invoice Approval (Invoice No:#{{$invoice->invoice_no}}) Date: {{date('d-m-Y',strtotime($invoice->date))}}
								<a class="btn btn-sm btn-success float-right" href="{{route('invoices.invoice.view')}}"><i class="fa fa-list"></i> Invoice List</a>
							</h5>
						</div>
						<form method="post" action="{{route('invoices.invoice.update-approve',$invoice->id)}}" id="myForm">
							@csrf
							<div class="card-body">
								@php
						      		$invoice_payment = App\Model\InvoicePayment::where('invoice_id',$invoice->id)->first();
						      	@endphp
								<table width="100%">
						        	<tbody>
						        		<tr>
						        			<td width="15%">
						        				<p style="font-size: 16px;font-weight: bold;">Customer Info:</p>
						        			</td>
						        			<td width="25%">
						        				<p style="font-size: 14px;border-bottom: 1px dotted #000;width: 100%">Name : {{$invoice_repayment['customer']['name']}}</p>
						        			</td>
						        			<td width="30%">
						        				<p style="font-size: 14px;border-bottom: 1px dotted #000;width: 100%">Mobile : {{$invoice_repayment['customer']['mobile']}}</p>
						        			</td>
						        			<td width="30%">
						        				<p style="font-size: 14px;border-bottom: 1px dotted #000;width: 100%">Address : {{$invoice_repayment['customer']['address']}}</p>
						        			</td>
						        		</tr>
						        		<tr>
						        			<td width="15%"></td>
						        			<td colspan="2" width="85%">
						        				<p>Description: {{$invoice->description}}</p>
						        			</td>
						        		</tr>
						        	</tbody>
						        </table>
						        <table border="1" style="margin-bottom: 5px; width:100%">
						          <thead>
						            <tr>
						              <th>SL</th>
						              <th>Product Name</th>
						              <th>Serial No</th>
						              <th>Warranty</th>
						              <th>Fee Qty</th>
						              <th>Qty</th>
						              <th width="11%">Unit Price</th>
						              <th width="12%">Amount</th>
						            </tr>
						          </thead>
						          <tbody>
						          	@php
						          		$product_sale_sum = 0;
						          	@endphp
						          	@foreach($invoice['invoice_details'] as $key => $details)
						            <tr>
						            	<td>{{$key+1}}</td>
						            	<td>{{$details['product']['name']}}</td>
						            	<td>{{$details->serial_no}}</td>
						            	<td>{{$details->warranty}}</td>
						            	<td>{{$details->free_selling_qty}}</td>
						            	<td>{{$details->selling_qty}} TK</td>
						            	<td>{{$details->selling_price}} TK</td>
						            	<td>{{$details->selling_qty*$details->selling_price}} TK</td>
						            	@php
						            		$product_sale_sum += $details->selling_price;
						            	@endphp
						            </tr>
						            @endforeach
						            <tr>
						            	<td colspan="6" rowspan="7"></td>
						            	<td><p style="font-weight: bold;">Total</p></td>
						            	<td><p style="font-weight: bold;">{{$product_sale_sum}} TK</p></td>
						            </tr>
						            <tr>
						            	<td><p style="font-weight: bold;">Already Paid</p></td>
						            	<td><p style="font-weight: bold;">{{$invoice_payment->paid_amount}} TK</p></td>
						            </tr>
						            <tr>
						            	@php
						            		if($invoice_repayment->paid_status=='full_paid'){
							            		$due_amount = '0';
						            		}else{
							            		$due_amount = $invoice_payment->due_amount-$invoice_repayment->paid_amount;
						            		}
						            	@endphp
						            	<td><p style="font-weight: bold;">Current Paid</p></td>
						            	<td><p style="font-weight: bold;">
						            		@if($invoice_repayment->paid_status=='full_paid')
						            		{{$invoice_payment->due_amount}}
						            		@elseif($invoice_repayment->paid_status=='partial_paid')
						            		{{$invoice_repayment->paid_amount}} TK
						            		@endif
						            	</p></td>
						            </tr>
						            <tr>
						            	<td><p style="font-weight: bold;">Due</p></td>
						            	<td><p style="font-weight: bold;">{{round($due_amount, 2)}} TK</p></td>
						            </tr>
						            <tr>
						            	<td><p style="font-weight: bold;">Payment Method</p></td>
						            	<td><p style="font-weight: bold;">{{$invoice_repayment->payment_method}}</p></td>
						            </tr>
						            @if($invoice_repayment->payment_method=='Cheque')
						            <tr>
						            	<td><p style="font-weight: bold;">Bank & Cheque No</p></td>
						            	<td><p style="font-weight: bold;">{{$invoice_repayment->bank_name}} - ({{$invoice_repayment->cheque_no}})</p></td>
						            </tr>
						            @endif
									<input type="hidden" name="customer_id" value="{{$invoice_repayment->customer_id}}">
						            <input type="hidden" name="due_paid_amount" value="{{$invoice_repayment->due_paid_amount}}">
						            <input type="hidden" name="date" value="{{$invoice_repayment->date}}">
						            <input type="hidden" name="payment_method" value="{{$invoice_repayment->payment_method}}">
						            <input type="hidden" name="paid_status" value="{{$invoice_repayment->paid_status}}">
						            <input type="hidden" name="paid_amount" value="{{$invoice_repayment->paid_amount}}">
						            <input type="hidden" name="bank_name" value="{{$invoice_repayment->bank_name}}">
						            <input type="hidden" name="cheque_no" value="{{$invoice_repayment->cheque_no}}">
					            	<input type="hidden" name="customer_paid_amount" value="{{$invoice_repayment->paid_amount}}">
					            	<input type="hidden" name="invoice_repayment_id" value="{{$invoice_repayment->id}}">
						          </tbody>
						        </table><br/>
								<button type="submit" class="btn btn-primary">Invoice Approve</button>
								<a href="{{route('invoices.invoice.update-reject').'?id='.$invoice_repayment->id}}" data-id="{{$invoice_repayment->id}}" class="btn btn-danger pull-right">Invoice Reject</a>
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