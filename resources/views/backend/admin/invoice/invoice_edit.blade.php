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
							<h5>Invoice Update (Invoice No:#{{$invoice['invoice_no']}}) Date: {{date('d-m-Y',strtotime($invoice['date']))}}
								<a class="btn btn-sm btn-success float-right" href="{{route('invoices.invoice.due')}}"><i class="fa fa-list"></i>Due Invoice List</a>
							</h5>
						</div>
						<form method="post" action="{{route('invoices.invoice.update',$invoice->id)}}" id="myForm">
							@csrf
							<div class="card-body">
								<input type="hidden" name="customer_id" value="{{$invoice->customer_id}}">
								<table width="100%">
						        	<tbody>
						        		<tr>
						        			<td width="15%">
						        				<p style="font-size: 16px;font-weight: bold;">Customer Info:</p>
						        			</td>
						        			<td width="25%">
						        				<p style="font-size: 14px;border-bottom: 1px dotted #000;width: 100%">Name : {{$invoice['customer']['name']??' '}}</p>
						        			</td>
						        			<td width="30%">
						        				<p style="font-size: 14px;border-bottom: 1px dotted #000;width: 100%">Mobile : {{$invoice['customer']['mobile']?? ''}}</p>
						        			</td>
						        			<td width="30%">
						        				<p style="font-size: 14px;border-bottom: 1px dotted #000;width: 100%">Address : {{$invoice['customer']['address']?? ' '}}</p>
						        			</td>
						        		</tr>
						        		<tr>
						        			<td width="15%"></td>
						        			<td width="85%" colspan="2">
						        				<p>Description: {{$invoice['invoice']['description'] ?? ' '}}</p>
						        			</td>
						        		</tr>
						        	</tbody>
						        </table>
						        <table border="1" style="margin-bottom: 5px; width: 100%">
						          <thead>
						            <tr>
						              <th class="text-center">SL</th>
						              <th class="text-center">Product Name</th>
						              <th class="text-center">Serial No</th>
						              <th class="text-center" >Warranty</th>
						              <th class="text-center">Fee Qty</th>
						              <th class="text-center">Qty</th>
						              <th class="text-center" width="11%">Unit Price</th>
						              <th class="text-center"  width="12%">Amount</th>
						            </tr>
						          </thead>
						          <tbody>
						          	@php

						          		$product_sale_sum = 0;
						          	@endphp
						          	@foreach($invoice->invoice_details as $key => $details)
						            <tr>
						            	<td class="text-right" >{{$key+1}}</td>
						            	<td class="text-center" >{{$details['product']['name']}}</td>
						            	<td class="text-right" >{{$details->serial_no}}</td>
						            	<td class="text-right" >{{$details->warranty}}</td>
						            	<td class="text-right" >{{$details->free_selling_qty}}</td>
						            	<td class="text-right">{{$details->selling_qty}} TK</td>
						            	<td class="text-right">{{$details->selling_price}} TK</td>
						            	<td class="text-right">{{$details->total_price}} TK</td>
						            	{{-- @php
						            		$product_sale_sum += $details->total_price;
						            	@endphp --}}
						            </tr>
						            @endforeach
						            <tr>
						            	<td colspan="6" rowspan="7"></td>
						            	<td  class="text-right"><p style="font-weight: bold;">Total</p></td>
						            	<td  class="text-right"><p style="font-weight: bold;">
                                            {{ number_format($invoice->total_amount, 2) }} TK</p></td>
						            </tr>
						            <tr>
						            	{{-- <td colspan="6" rowspan="7"></td> --}}
						            	<td  class="text-right"><p style="font-weight: bold;">Interest Amount</p></td>
						            	<td  class="text-right"><p style="font-weight: bold;">
                                        {{ number_format($invoice->intertest_amount, 2) }} TK</p></td>
						            </tr>
						            <tr>
						            	{{-- <td colspan="6" rowspan="7"></td> --}}
						            	<td  class="text-right"><p style="font-weight: bold;">Grand Total</p></td>
						            	<td  class="text-right"><p style="font-weight: bold;">
                                            {{ number_format($invoice->grand_total, 2) }} TK</p></td>
						            </tr>
						            <tr>
						            	<td  class="text-right"><p style="font-weight: bold;">Paid</p></td>
						            	<td  class="text-right"><p style="font-weight: bold;">
                                            {{number_format($invoice->paid_amount, 2)}} TK</p></td>
						            </tr>
						            <tr>
						            	<td  class="text-right"><p style="font-weight: bold;">Due</p></td>
						            	<td  class="text-right">
						            		{{-- <input type="hidden" name="new_paid_amount" value="{{$invoice->due_amount}}"> --}}
						            		<p style="font-weight: bold;">{{number_format($invoice->due_amount, 2)}} TK</p>
						            	</td>
						            </tr>
						          </tbody>
						        </table>
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title text-center">
                                            <input class="checkbox-inline no-margin" type="checkbox" id="pay-via-installments" name="payViaInstallment" value="1">
                                            Reminder for Due Amount </h4>
                                    </div>
                                  <div class="card-body installment-section ">
                                        @forelse ($invoice->installment as $installment)

                                            <div class="form-row">
                                                <div class="form-group col-sm-2">
                                                    <label class="control-label">Date</label>
                                                    <input type="text"  class="form-control form-control-sm"  value="{{ $installment->date }}" readonly required>

                                                </div>
                                                <div class="form-group col-sm-2" >
                                                    <label class="control-label">Amount</label>
                                                    <input type="text" id="" class="form-control form-control-sm "
                                                    name="due"
                                                    value="{{ $installment->amount }}"
                                                      style="text-align: center;padding: 2px 0px 2px 0px;" readonly
                                                    onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                                </div>

                                                <div class="form-group col-sm-1" >
                                                    <label class="control-label">Interest(%)</label>
                                                    <input type="text" id=""  class="form-control form-control-sm"
                                                    style="text-align: center;padding: 2px 0px 2px 0px;"
                                                    required
                                                    value="{{ $installment->interest }}"
                                                    onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                                </div>
                                                @php

                                                        $amount     = $installment->amount?? 0;
                                                        $interest   = $installment->interest?? 0;
                                                        $daycount   = $installment->dayCount??0 ;
                                                       
                                                        if($daycount > 0 ){
                                                            $interestAmount = $daycount * ($amount * $interest)/100;
                                                            $totalAmount =  $interestAmount + $amount;
                                                        }else{
                                                            $interestAmount = 0;
                                                            $totalAmount =  $amount ;
                                                        }
                                                    @endphp
                                                <div class="form-group col-sm-1" >
                                                    <input type="hidden" name="interestamount" value="{{ $interestAmount }}">
                                                    <label class="control-label">Cross Days </label>
                                                    <input type="text" id="" name="crossDays" class="form-control form-control-sm"  style="text-align: center;padding: 2px 0px 2px 0px;"
                                                    required
                                                    value="{{ $daycount }}" readonly
                                                    onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                                </div>
                                                <div class="form-group col-sm-3" >
                                                    <label class="control-label">Paid Amount </label>
                                                    <input type="text" id="" name="inspaidAmount" class="form-control form-control-sm"  style="text-align: center;padding: 2px 0px 2px 0px;"
                                                    required
                                                    value= "{{ $totalAmount }}"
                                                    readonly
                                                    onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                                </div>
                                                @if ($installment->paid_amount > 0)
                                                    <div class="form-group col-sm-2" >
                                                        <label class="control-label">Given Amount </label>
                                                        <input type="text" id="" name="inspaidAmount" class="form-control form-control-sm"  style="text-align: center;padding: 2px 0px 2px 0px;"
                                                        required
                                                        value= "{{ $installment->paid_amount  }}"
                                                        readonly
                                                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                                    </div>
                                                @else

                                                @endif
                                                <div class="form-group col-sm-1" >
                                                    <label class="control-label">Click </label>
                                                    <button type="button"  style="text-align: center;" class="btn btn-primary addMore btn-sm"> + Add </button>
                                                </div>

                                            </div>
                                        @empty

                                        @endforelse

                                        <span id="addMoreHtml"></span>
                                  </div>

                                </div>
						        <div class="form-row">
						        	<div class="col-md-3">
					              		<label>Date</label>
					              		<input type="text" name="date" id="date" class="form-control form-control-sm singledatepicker" placeholder="YYYY-MM-DD" value="{{date('Y-m-d')}}" required="" readonly="">
					              	</div>
									<div class="col-md-3">
					              		<label>Payment Method</label>
					              		<select name="payment_method" id="payment_method" class="payment_method form-control form-control-sm">
											<option value="">Select Method</option>
											<option value="HandCash">HandCash</option>
											<option value="Cheque">Cheque</option>
										</select>
					              	</div>
									<div class="col-md-4">
										<label class="control-label">Paid Status</label>
										<select name="paid_status" id="paid_status" class="paid_status form-control form-control-sm">
											<option value="">Select Status</option>
											<option value="partial_paid">Partial Paid</option>
											<option value="full_paid">Full Paid</option>
										</select>
									</div>
									<div class="col-md-2" style="padding-top: 30px;">
										<input type="text" name="paid_amount" class="paid_amount form-control form-control-sm" placeholder="Write Paid Amount" id="paid_amount" autocomplete="off" style="display: none;" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
									</div>

									<div class="form-row bank_info" style="display: none; padding-top: 15px;">
										<div class="col-md-6">
											<input type="text" name="bank_name" class=" form-control form-control-sm" placeholder="Write Bank Name">
										</div>
										<div class="col-md-6">
											<input type="text" name="cheque_no" class=" form-control form-control-sm" placeholder="Write Cheque No">
										</div>
									</div>
								</div><br/>
                                <button type="submit" class="btn btn-primary btn-sm">Invoice Update</button>
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

{{-- Extra Others Field --}}
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
        $(document).on('click', '.addMore', function(){
            let Html =`<div class="form-row">
                                                <div class="form-group col-sm-2">
                                                    <label class="control-label">Date</label>
                                                    <input type="date" name="new_installmentDate" id="" class="form-control form-control-sm" placeholder="YYYY-MM-DD"  required>

                                                </div>
                                                <div class="form-group col-sm-2" >
                                                    <label class="control-label">Due Amount</label>
                                                    <input type="text" id="" class="form-control form-control-sm installAmount"
                                                    name="new_installAmount"  style="text-align: center;padding: 2px 0px 2px 0px;" readonly
                                                    onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                                </div>

                                                <div class="form-group col-sm-1" >
                                                    <label class="control-label">Interest(%)</label>
                                                    <input type="text" id="" name="new_installInterest" class="form-control form-control-sm installInterest"  style="text-align: center;padding: 2px 0px 2px 0px;"
                                                    required
                                                    onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                                </div>

                                            </div>`;
            $('#addMoreHtml').append(Html);
        })
        $(document).on('keyup click', '.paid_amount', function(){
            let installAmount = $('input[name=inspaidAmount]').val();

            $('.installAmount').val(parseFloat(installAmount) - parseFloat($(this).val()??0) )
        })

    });
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#myForm').validate({
			errorClass:'text-danger',
			validClass:'text-success',
			rules : {
				payment_method : {
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
