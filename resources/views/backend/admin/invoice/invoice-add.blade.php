@extends('backend.layouts.master')
{{-- @push('js')
<script src="{{ asset('jquery_ui/jquery-ui.min.js') }}"></script>
@endpush
@push('css')
<link rel="stylesheet" href="{{ asset('jquery_ui/jquery-ui.theme.css') }}">
@endpush --}}
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
							<h5>{{(@$editData) ? ("Update Invoice") : "Add Invoice"}}
								<a class="btn btn-sm btn-success float-right"
                                 href="{{route('invoices.invoice.view')}}"><i class="fa fa-list"></i> Invoice List</a>
							</h5>
						</div>

						<div class="card-body">
							<form>
                                <div class="form-row">
                                    <div class="form-group col-sm-1">

										<label class="control-label">Invoice No</label>
										<input type="text" name="invoice_no" class="form-control form-control-sm" value="{{@$invoice_no}}" id="invoice_no" readonly style="background: #F7FD91;text-align: center;padding: 2px 0px 2px 0px;">
									</div>
									<div class="form-group col-sm-2">
										<label class="control-label">Date</label>
										<input type="text" name="date" id="date" class="form-control form-control-sm singledatepickers" value="{{ date('Y-m-d') }}" placeholder="YYYY-MM-DD" readonly>
									</div>
									<div class="form-group col-sm-3">
										<label class="control-label">Product Category</label>
										<select class="form-control select2" name="category_id" id="category_id">
											<option value="">Select Category</option>
											@foreach($categories as $cat)
											<option value="{{$cat->id}}">{{$cat->name}}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group col-sm-3">
										<label class="control-label">Product Name</label>
										<select class="form-control select2" name="product_id" id="product_id">
											<option value="">Select Product</option>
										</select>
									</div>
									<div class="form-group col-sm-1" style="margin-right: 20px;">
										<label class="control-label">Sell Price</label>
										<input type="text" id="current_stock_qty" class="form-control form-control-sm" readonly style="background: #F7FD91;text-align: center;padding: 2px 0px 2px 0px;">
									</div>
									<div class="form-group col-sm-1" style="padding-top: 29px">
										<i id="search" class="btn btn-primary fa fa-plus-circle addeventmore"> Add Item</i>
									</div>
								</div>
							</form>
						</div>

						<div class="card border-info">
							<form method="post" action="{{route('invoices.invoice.store')}}" id="myForm">
								{{csrf_field()}}
								<div class="card-body">
									<table class="table-sm table-bordered" width="100%">
										<thead>
											<tr class="text-center">
												<th>Category Name</th>
												<th>Product Name</th>
												<th width="7%">Serial No</th>
												<th width="10%">Warranty</th>
												<th width="7%">Free Qty</th>
												<th width="7%">Pcs/Kg</th>
												<th width="10%">Unit Price</th>
												<th width="10%">Total Price</th>
												<th width="5%">Action</th>
											</tr>
										</thead>
										    <tbody id="addRow" class="addRow">
										</tbody>
										<tbody>
											<tr>
												<td colspan="7" class="text-right"><strong>Grand Total</strong></td>
												<td>
													<input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control form-control-sm text-right estimated_amount" readonly style="background-color: #D8FDBA">
												</td>
												<td></td>
											</tr>
										</tbody>
									</table>
									<br/>
									<div class="form-row">
										<div class="col-md-12">
											<textarea name="description" class="form-control form-control-sm" id="description" placeholder="Write Description here"></textarea>
										</div>
									</div><br>


									<div class="form-row">
										<div class="col-md-3">
						              		<label>Payment Method</label>
						              		<select name="payment_method" id="payment_method" class="payment_method form-control form-control-sm">
												<option value="">Select Method</option>
												<option value="HandCash">HandCash</option>
												<option value="Cheque">Cheque</option>
											</select>
						              	</div>
										<div class="col-md-3">
											<label class="control-label">Paid Status</label>
											<select name="paid_status" id="paid_status" class="paid_status form-control form-control-sm">
												<option value="">Select Status</option>
												<option value="partial_paid">Partial Paid</option>
												<option value="full_paid">Full Paid</option>

											</select>
										</div>
										<div class="col-md-2" style="padding-top: 30px;">
											<input type="text" name="paid_amount" class="paid_amount form-control form-control-sm" placeholder="Write Paid Amount" id="paid_amount" autocomplete="off" style="display: none;"
											onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
										</div>
										<div class="col-md-2" style="padding-top: 30px;">
											<input type="text" name="due_amount" class="due_amount form-control form-control-sm" placeholder="Here Due Amount" id="due_amount" autocomplete="off" style="display: none;" readonly
											onkeypress='return event.charCode >= 48 && event.charCode <= 57' >
										</div>
										<div class="form-row bank_info" style="display: none; padding-top: 15px;">
											<div class="col-md-6">
												<input type="text" name="bank_name" class=" form-control form-control-sm" placeholder="Write Bank Name">
											</div>
											<div class="col-md-6">
												<input type="text" name="cheque_no" class=" form-control form-control-sm" placeholder="Write Cheque No">
											</div>
										</div>
									</div>

                                    {{-- Installment --}}
                                    <div id="installment-section"></div>


									<div class="form-row">
										<div class="col-md-10">
											<label class="control-label">Customer Name</label>
											<select name="customer_id" id="customer_id" class="customer_id form-control select2">
												<option value="">Select Customer</option>
												@foreach($customers as $customer)
												<option value="{{$customer->id}}">{{$customer->name}} -{{$customer->mobile}} ({{$customer->address}})</option>
												@endforeach
											</select>
										</div>
										<div class="col-md-2">
							                <label>Due Balance</label>
							                <input type="text" name="stock_amount" id="stock_amount" class="form-control form-control-sm" readonly>
						              	</div>
									</div>
									<br>
									<div class="form-group">
										<button type="submit" class="btn btn-sm btn-primary"
                                        id="storeButton" disabled> Invoice Store</button>
									</div>
								</div>
							</form>
						</div>


					</div>
				</div>
			</div>

        </div>
        <!-- END container-fluid -->

    </div>
    <!-- END content -->

</div>
<!-- END content-page -->
<script id="document-template" type="text/x-handlebars-template">
	<tr class="delete_add_more_item" id="delete_add_more_item">
		<td>
			<input type="hidden" name="invoice_no" value="@{{invoice_no}}">
			<input type="hidden" name="date" value="@{{date}}">
			<input type="hidden" name="category_id[]" value="@{{category_id}}">
			@{{category_name}}
		</td>
		<td>
			<input type="hidden" name="product_id[]" value="@{{product_id}}">
			@{{product_name}}
		</td>
		<td>
			<input type="text" name="serial_no[]" class="form-control form-control-sm">
		</td>
		<td>
			<input type="text" name="warranty[]" class="form-control form-control-sm">
		</td>
		<td>
			<input type="text" class="form-control form-control-sm" name="free_selling_qty[]">
		</td>
		<td>
			<input type="number" min="1" class="form-control form-control-sm text-right selling_qty" name="selling_qty[]"  value="1">
		</td>
		<td>
			<input type="number" class="form-control form-control-sm text-right selling_price" name="selling_price[]"  value="@{{sell_price}}">
			<input type="hidden" class="form-control form-control-sm text-right selling_price"
            name="unit_price[]"  value="@{{sell_price}}">
		</td>
		<td>
			<input class="form-control form-control-sm text-right total_price" name="total_price[]"  value="0" readonly>
		</td>
		<td>
			<i class="btn btn-danger fa fa-close removeeventmore"> </i>
		</td>

	</tr>
</script>

<!-- extra_add_exist_item -->
<script type="text/javascript">
	$(document).ready(function () {
		$(document).on("click",".addeventmore", function () {
			var category_id = $('#category_id').val();
			var sell_price = $('#current_stock_qty').val();
			var category_name = $('#category_id').find('option:selected').text();
			var product_id = $('#product_id').val();
			var product_name  = $('#product_id').find('option:selected').text();
			var date = $('#date').val();

			$('.notifyjs-corner').html('');

			if(date ==''){
				$.notify("Date is required", {globalPosition: 'top right',className: 'error'});
				return false;
			}
			if(category_id ==''){
				$.notify("Category is required", {globalPosition: 'top right',className: 'error'});
				return false;
			}
			if(product_id ==''){
				$.notify("Product is required", {globalPosition: 'top right',className: 'error'});
				return false;
			}
			if(sell_price ==''){
				$.notify("sell price is required", {globalPosition: 'top right',className: 'error'});
				return false;
			}

			var source = $("#document-template").html();
			var template = Handlebars.compile(source);
			var data= {date:date,category_id:category_id,category_name:category_name,product_id:product_id,product_name:product_name, 'sell_price': sell_price };
			var html = template(data);
			$("#addRow").append(html);
		});

		$(document).on("click", ".removeeventmore", function (event) {
			$(this).closest(".delete_add_more_item").remove();
			totalAmountPrice();
		});

		$(document).on('keyup click','.selling_price,.selling_qty',function(){
			var selling_price 	= $(this).closest("tr").find(".selling_price").val();
			var qty 		= $(this).closest("tr").find(".selling_qty").val();
			var total 		= selling_price * qty;
			$(this).closest("tr").find(".total_price").val(total);
			totalAmountPrice();
		});

		//calculate sum of amount in invoice
		function totalAmountPrice(){
			var sum=0;
			$(".total_price").each(function(){
				var value = $(this).val();
				if(!isNaN(value) && value.length != 0) {
					sum += parseFloat(value);
				}
			});
			$('#estimated_amount').val(sum);
		}
	});

	$(function(){
		$(document).on('change','#category_id',function(){
			var category_id = $(this).val();
			$.ajax({
				url:"{{route('get-product')}}",
				type:"GET",
				data:{category_id:category_id},
				success:function(data){
					var html = '<option value="">Select Product</option>';
					$.each( data, function( key, v ) {
						html +='<option value="'+v.id+'">'+v.name+'</option>';
					});
					$('#product_id').html(html);
	                var product_id = "{{@$editData->product_id}}";
	                if(product_id !=''){
	                	$('#product_id').val(product_id);
	                }
				}
			});
		});
	});

	$(function(){
		$(document).on('change','#product_id',function(){
			var category_id = $('#category_id').val();
			var product_id = $('#product_id').val();
			$.ajax({
				url:"{{route('get-product-count')}}",
				type:"GET",
				data:{'category_id':category_id,'product_id':product_id},
				success:function(data){
	                $('#current_stock_qty').val(data);
				}
			});
		});
	});

	$(function(){
		$(document).on('change','.customer_id',function(){
			var customer_id = $('#customer_id').val();
			$.ajax({
				url:"{{route('invoices.customer-due-balance')}}",
				type:"GET",
				data:{'customer_id':customer_id},
				success:function(data){
                    console.log(data, 'data');
	                $('#stock_amount').val(data??0);
				}
			});
		});
	});



    $(document).ready(function(){

    	//Customer name
        $(document).on('change','.customer_id',function(){
            var customer_id = $(this).val();
            if(customer_id == '0'){
                $('.new_customer').show();
            }else{
                $('.new_customer').hide();
            }
        });
        //Paid amount
        $(document).on('change','.paid_status',function(){
            var paid_status = $(this).val();
            if(paid_status == 'partial_paid'){
                $('.paid_amount').show();
                $('.due_amount').show();
            }else{
                $('.paid_amount').hide();
                $('.due_amount').hide();
            }
        });
		$(document).on('focus keyup blur', '.paid_amount', function(){
			let paidAmount = parseFloat($(this).val())||0,
                grandTotal = parseFloat($('.estimated_amount').val()),
                installAmount = $(".installAmount").val();
                due_amount = $(".due_amount").val();

			if (paidAmount < grandTotal) {
                $('.due_amount').val(grandTotal - paidAmount);
                $('.installAmount').val(grandTotal - paidAmount);
			}else{
                $('.due_amount').val(0);
                $('.installAmount').val(0);
            }

            if(Number(installAmount) == Number(due_amount)){
                $("#storeButton").removeAttr("disabled");
                    return true;
            }else{
                $("#storeButton").attr("disabled", true);
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

	$(document).ready(function(){
		$('#myForm').validate({
			ignore:[],
			errorPlacement: function(error, element){
				if (element.attr("name") == "customer_id" ){ error.insertAfter(element.next()); }
				else{error.insertAfter(element);}
			},
			errorClass:'text-danger',
			validClass:'text-success',
			rules : {
				payment_method : {
					required : true,
				},
				customer_id : {
					required : true,
				},
				paid_status : {
					required : true,
				},
				// address : {
				// 	required : true,
				// },
			},
			messages : {

			}
		});
	});

    $('#pay-via-installments').on('click', function () {
        let checked = $('#pay-via-installments:checked').val();
        switch(checked){
            case '1':
                $('#installment-section').append(html());
                break;
            default:
                $('#installment-section').empty();
                break;
        }
    });


    function html(){
        let html = `<div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-center">
                                <input class="checkbox-inline no-margin" type="checkbox" id="pay-via-installments" name="payViaInstallment" value="1">
                                Reminder for Due Amount </h4>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-sm-2">
                                    <label class="control-label">Date</label>
                                    <input type="date" name="installmentDate" id="date" class="form-control form-control-sm singledatepickers" placeholder="YYYY-MM-DD"  required>

                                </div>
                                <div class="form-group col-sm-1" style="margin-right: 20px;">
                                    <label class="control-label">Amount</label>
                                    <input type="text" id="" class="form-control form-control-sm installAmount"
                                    name="installAmount"  style="text-align: center;padding: 2px 0px 2px 0px;" readonly
                                    onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                </div>

                                <div class="form-group col-sm-1" style="margin-right: 20px;">
                                    <label class="control-label">Interest(%)</label>
                                    <input type="text" id="" name="installInterest" class="form-control form-control-sm installInterest"  style="text-align: center;padding: 2px 0px 2px 0px;"
                                    required
                                    onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                </div>



                            </div>

                        </div>
                    </div>`;
        return html;
    }

    function buttonValidation(){
        let  installAmount = $(".installAmount").val(), due_amount  = $(".due_amount").val();
           if(Number(installAmount) == Number(due_amount)){
            $("#storeButton").removeAttr("disabled");
                return true;
           }

    }

    $(document).on('click','.removeInstallment', function (e) {
        $(this).closest('.card-body').remove();

    });




$(function(){
    $(document).on('change', '#paid_status', function(e){
        let paidStatus =  $(this).val();
        if(paidStatus == "full_paid"){
            $('#installment-section').empty();
            $('#pay-via-installments').removeAttr('checked');
            $("#storeButton").removeAttr("disabled");
            return true;
        }else{
            $('#installment-section').append(html());
            $('#pay-via-installments').attr('checked', true );
            $.notify("Please Add Installment Process.", {globalPosition: 'top right',className: 'error'});
            buttonValidation();
            $("#storeButton").attr("disabled", true);
        }
    });
});
</script>


@endsection
