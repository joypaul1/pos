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
							<h5>Purchase Update (Purchase No:#{{$purchase['purchase']['purchase_no']}}) Date: {{date('d-m-Y',strtotime($purchase['purchase']['date']))}}
								<a class="btn btn-sm btn-success float-right" href="{{route('purchases.purchase.due')}}"><i class="fa fa-list"></i>Due Purchase List</a>
							</h5>
						</div>
						<form method="post" action="{{route('purchases.purchase.update',$purchase->purchase_id)}}" id="myForm">
							@csrf
							<div class="card-body">
								<input type="hidden" name="supplier_id" value="{{$purchase->supplier_id}}">
								<table width="100%">
						        	<tbody>
						        		<tr>
						        			<td width="15%">
						        				<p style="font-size: 16px;font-weight: bold;">Supplier Info:</p>
						        			</td>
						        			<td width="25%">
						        				<p style="font-size: 14px;border-bottom: 1px dotted #000;width: 100%">Name : {{$purchase['supplier']['name']}}</p>
						        			</td>
						        			<td width="30%">
						        				<p style="font-size: 14px;border-bottom: 1px dotted #000;width: 100%">Mobile : {{$purchase['supplier']['mobile']}}</p>
						        			</td>
						        			<td width="30%">
						        				<p style="font-size: 14px;border-bottom: 1px dotted #000;width: 100%">Address : {{$purchase['supplier']['address']}}</p>
						        			</td>
						        		</tr>
						        		<tr>
						        			<td width="15%"></td>
						        			<td width="85%" colspan="2">
						        				<p>Description: {{$purchase['purchase']['description']}}</p>
						        			</td>
						        		</tr>
						        	</tbody>
						        </table>
						        <table border="1" style="margin-bottom: 5px; width: 100%">
						          <thead>
						            <tr>
						              <th>SL</th>
						              <th>Category</th>
						              <th>Product Name</th>
						              <th>Pcs</th>
						              <th>Rate</th>
						              <th>Price</th>
						            </tr>
						          </thead>
						          <tbody>
						          	@php
						          		$purchase_details = App\Model\PurchaseDetail::where('purchase_id',$purchase->purchase_id)->get();
						          		$product_sale_sum = 0;
						          	@endphp
						          	@foreach($purchase_details as $key => $details)
						            <tr>
						            	<td>{{$key+1}}</td>
						            	<td>{{@$details['category']['name']}}</td>
						            	<td>{{@$details['product']['name']}}</td>
						            	<td>{{$details->buying_qty}}</td>
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
						            	<td><p style="font-weight: bold;">Paid</p></td>
						            	<td><p style="font-weight: bold;">{{round($purchase->paid_amount, 2)}} TK</p></td>
						            </tr>
						            <tr>
						            	<td><p style="font-weight: bold;">Due</p></td>
						            	<td>
						            		<input type="hidden" name="new_paid_amount" value="{{$purchase->due_amount}}">
						            		<p style="font-weight: bold;">{{round($purchase->due_amount, 2)}} TK</p>
						            	</td>
						            </tr>
						          </tbody>
						        </table>
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
										<input type="text" name="paid_amount" class="paid_amount form-control form-control-sm" placeholder="Write Paid Amount" id="paid_amount" autocomplete="off" style="display: none;">
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
								<button type="submit" class="btn btn-primary btn-sm">Purchase Update</button>
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