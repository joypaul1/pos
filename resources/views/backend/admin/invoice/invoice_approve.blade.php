@extends('backend.layouts.master')
@section('content')
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
							<h5>Approve Invoice
								<a class="btn btn-sm btn-success float-right" href="{{route('invoices.invoice.view')}}"><i class="fa fa-list"></i> Invoice List</a>
							</h5>
						</div>

						<form method="post" action="{{route('invoices.invoice.approve',$invoice->id)}}" id="myForm">
							@csrf
							<div class="card-body">
								@php
						      		$invoice_payment = App\Model\InvoicePayment::where('invoice_id',$invoice->id)->first();
						      		$invoice_payment_details = App\Model\InvoicePaymentDetail::where('invoice_id',$invoice->id)->first();
						      	@endphp
								<table width="100%">
									<input type="hidden" name="customer_id" value="{{$invoice_payment->customer_id}}">
						        	<tbody>
						        		<tr>
						        			<td width="15%">
						        				<p style="font-size: 16px;font-weight: bold;">Customer Info:</p>
						        			</td>
						        			<td width="25%">
						        				<p style="font-size: 14px;border-bottom: 1px dotted #000;width: 100%">Name : {{$invoice_payment['customer']['name']}}</p>
						        			</td>
						        			<td width="30%">
						        				<p style="font-size: 14px;border-bottom: 1px dotted #000;width: 100%">Mobile : {{$invoice_payment['customer']['mobile']}}</p>
						        			</td>
						        			<td width="30%">
						        				<p style="font-size: 14px;border-bottom: 1px dotted #000;width: 100%">Address : {{$invoice_payment['customer']['address']}}</p>
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
						        <table border="1" style="margin-bottom: 5px;">
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
						            	<input type="hidden" name="category_id[]" value="{{$details->category_id}}">
						            	<input type="hidden" name="product_id[]" value="{{$details->product_id}}">
						            	<input type="hidden" name="customer_paid_amount" value="{{$invoice_payment->paid_amount}}">
						            	<td>{{$key+1}}</td>
						            	<td>{{$details['product']['name']}}</td>
						            	<td>{{$details->serial_no}}</td>
						            	<td>{{$details->warranty}}</td>
						            	<td width="7%">
						            		<input type="number" name="free_selling_qty[{{$details->id}}]" value="{{$details->free_selling_qty}}" class="form-control form-control-sm" readonly>
						            	</td>
						            	<td width="12%">
						            		<input type="number" name="selling_qty[{{$details->id}}]" value="{{$details->selling_qty}}" class="form-control form-control-sm" readonly>
						            	</td>
						            	<td>{{$details->selling_price}} TK</td>
						            	@php
						            		$total_amount = $details->selling_qty*$details->selling_price;
						            	@endphp
						            	<td>{{$total_amount}} TK</td>
						            	@php
						            		$product_sale_sum += $total_amount;
						            	@endphp
						            </tr>
						            @endforeach
						            <tr>
						            	<td colspan="6" rowspan="7"></td>
						            	<td><p style="font-weight: bold;">Total</p></td>
						            	<td><p style="font-weight: bold;">{{$product_sale_sum}} TK</p></td>
						            </tr>
						            <tr>
						            	<td><p style="font-weight: bold;">Paid</p></td>
						            	<td><p style="font-weight: bold;">{{$invoice_payment->paid_amount}} TK</p></td>
						            </tr>
						            <tr>
						            	<td><p style="font-weight: bold;">Due</p></td>
						            	<td><p style="font-weight: bold;">{{round($invoice_payment->due_amount, 2)}} TK</p></td>
						            </tr>
						            <tr>
						            	<td><p style="font-weight: bold;">Payment Method</p></td>
						            	<td><p style="font-weight: bold;">{{$invoice_payment->payment_method}}</p></td>
						            </tr>
						            @if($invoice_payment->payment_method=='Cheque')
						            <tr>
						            	<td><p style="font-weight: bold;">Bank & Cheque No</p></td>
						            	<td><p style="font-weight: bold;">{{$invoice_payment_details->bank_name}} - ({{$invoice_payment_details->cheque_no}})</p></td>
						            </tr>
						            @endif
					            	<input type="hidden" name="customer_total_amount" value="{{$product_sale_sum}}">
					            	<input type="hidden" name="customer_due_amount" value="{{$invoice_payment->due_amount}}">
						          </tbody>
						        </table><br/>
                                {{-- @dd($invoice->dayCount) --}}
                                <div class="card text-center">
                                    <div class="card-header">
                                        Deu Reminder Process
                                    </div>
                                    <div class="card-body">
                                        <table border="1" width="100%" style="margin-bottom: 5px;">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Amount</th>
                                                    <th>Interset</th>
                                                    <th>Counting Passing Date Cross</th>
                                                    <th>Interset Amount</th>
                                                    <th>Total Amount</th>
                                                </tr>
                                                <tbody>
                                                    @php
                                                        $amount = optional($invoice->installment)->amount?? 0;
                                                        $interest = optional($invoice->installment)->interest?? 0;
                                                        $daycount = $invoice->dayCount??0 ;
                                                        if($daycount > 0 ){
                                                            $interestAmount = $daycount * ($amount * $interest)/100;
                                                            $totalAmount =  $interestAmount + $amount;
                                                        }else{
                                                            $interestAmount = 0;
                                                            $totalAmount =  $amount ;
                                                        }
                                                    @endphp

                                                    <tr>

                                                        <td {{date('d-m-Y', strtotime( optional($invoice->installment)->date)) }}</td>
                                                        <td>{{ $amount }}</td>
                                                        <td>{{ $interest }}</td>
                                                        <td>{{ $daycount  }}</td>
                                                        <td>{{ $interestAmount  }}</td>
                                                        <td>{{ $totalAmount  }}</td>
                                                    </tr>


                                                </tbody>
                                            </thead>
                                        </table>
                                    </div>
                                </div>

								<button type="submit" class="btn btn-primary">Invoice Approve</button>
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

<script type="text/javascript">
    $(document).ready(function(){
        //Paid amount
        $(document).on('change','.paid_status',function(){
            var paid_status = $(this).val();
            if(paid_status == 'partial_paid'){
                $('.paid_amount').show();
            }else{
                $('.paid_amount').hide();
            }
        });
        //Pament Method
        $(document).on('change','.payment_method',function(){
            var payment_method = $(this).val();
            if(payment_method == 'Cheque'){
                $('.bank_info').show();
            }else{
                $('.bank_info').hide();
            }
        });
    });
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#myForm').validate({
			ignore:[],
            errorPlacement: function(error, element){
                if (element.attr("name") == "project_id" ){ error.insertAfter(element.next()); }
                else if (element.attr("name") == "flat_id" ){error.insertAfter(element.next()); }
                else if (element.attr("name") == "customer_id" ){error.insertAfter(element.next()); }
                else{error.insertAfter(element);}
            },
			errorClass:'text-danger',
			validClass:'text-success',
			rules : {
				date : {
					required : true,
				},
				invoice_no : {
					required : true,
				},
				project_id : {
					required : true,
				},
				flat_id : {
					required : true,
				},
				customer_id : {
					required : true,
				},
				total_amount : {
					required : true,
				},
				paid_status : {
					required : true,
				},
			},
			messages : {

			}
		});
	});
</script>

@endsection
