@extends('backend.layouts.master')
@section('content')
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
							<h5>{{(@$editData) ? ("Update Purchase") : "Add Purchase"}}
								<a class="btn btn-sm btn-success float-right" href="{{route('purchases.purchase.view')}}"><i class="fa fa-list"></i> Purchase List</a>
							</h5>
						</div>

						<div class="card-body">
							<form>
								<div class="form-row">
									<div class="form-group col-md-4">
										<label class="control-label">Date <span style="color: red;">*</span></label>
										<input type="text" name="date" id="date" class="form-control form-control-sm singledatepicker" value="{{@$cdate}}" placeholder="YYYY-MM-DD" autocomplete="off" readonly>
									</div>
									<div class="form-group col-md-4">
										<label class="control-label">Invoice No <span style="color: red;">*</span></label>
										<input type="text" name="purchase_no" id="purchase_no" class="form-control form-control-sm" readonly
                                        value="#{{@$editData->purchase_no ?? @$invoice_no}}" placeholder="Write Invoice No">
									</div>
									<div class="form-group col-md-4">
										<label class="control-label">Supplier Name <span style="color: red;">*</span></label>
										<select name="supplier_id" id="supplier_id" class="form-control form-control-sm select2">
											<option value="">Select Supplier</option>
											@foreach($suppliers as $supplier)
						                	<option value="{{$supplier->id}}">{{$supplier->name}}</option>
						                	@endforeach
										</select>
									</div>
									<div class="form-group col-md-4">
										<label class="control-label">Category <span style="color: red;">*</span></label>
										<select name="category_id" id="category_id" class="category_id form-control form-control-sm select2">
											<option value="">Select Category</option>
										</select>
									</div>
									<div class="form-group col-md-6">
										<label class="control-label">Product Name <span style="color: red;">*</span></label>
										<select name="product_id" id="product_id" class="form-control form-control-sm select2">
											<option value="">Select Product</option>

										</select>
									</div>
									<div class="form-group col-md-1" style="padding-top: 29px;">
										<i class="btn btn-primary fa fa-plus-circle addeventmore"> Add</i>
									</div>
								</div>
							</form>
						</div>

						<div class="card border-info">
							<form method="post" action="{{route('purchases.purchase.store')}}" id="myForm">
								{{csrf_field()}}
								<div class="card-body">
									<table class="table-sm table-bordered" width="100%">
										<thead>
											<tr>
												<th>Category</th>
												<th>Product Name</th>
												<th width="7%">Pcs/Kg</th>
												<th width="10%">Unit Price</th>
												<th width="10%">Selling Price</th>
												<th width="7%">Free Qty</th>
												<th width="10%">Total Price</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody id="addRow" class="addRow">

										</tbody>
										<tbody>
												<tr>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
												<tr>
													<td colspan="6"></td>
													<td>
														<input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control form-control-sm text-right estimated_amount" readonly style="background-color: #D8FDBA">
													</td>
													<td></td>
												</tr>
											</tbody>
									</table>
									<br>
									<div class="form-row">
										<div class="col-md-12">
											<textarea name="description" class="form-control form-control-sm" id="description" placeholder="Write Description here"></textarea>
										</div>
									</div>
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
												<option value="full_due">Full Due</option>
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
									</div>
									<br>
									<div class="form-group">
										<button type="submit" class="btn btn-sm btn-primary" id="storeButton">Purchase Store</button>
									</div>
								</div>
							</form>
						</div>
						<!--Form End-->

					</div>
				</div>
			</div>

        </div>
        <!-- END container-fluid -->

    </div>
    <!-- END content -->

</div>
<!-- END content-page -->

<!-- Extra HTML for If exist Event -->
<script id="document-template" type="text/x-handlebars-template">
	<tr class="delete_add_more_item" id="delete_add_more_item">
		<input type="hidden" name="date" value="@{{date}}">
		<input type="hidden" name="purchase_no" value="@{{purchase_no}}">
		<input type="hidden" name="project_id" value="@{{project_id}}">
		<input type="hidden" name="supplier_id" value="@{{supplier_id}}">
		<td>
			<input type="hidden" name="category_id[]" value="@{{category_id}}">
			@{{category_name}}
		</td>
		<td>
			<input type="hidden" name="product_id[]" value="@{{product_id}}">
			@{{product_name}}
		</td>
		<td>
			<input type="number" min="1" class="form-control form-control-sm text-right buying_qty" name="buying_qty[]"  value="1">
		</td>
		<td>
			<input type="number" class="form-control form-control-sm text-right unit_price" name="unit_price[]"  value="">
		</td>
		<td>
			<input type="number" class="form-control form-control-sm text-right selling_price" name="selling_price[]"  value="1">
		</td>
		<td>
			<input type="number"  class="form-control form-control-sm text-right free_quantity" name="free_quantity[]">
		</td>
		<td>
			<input class="form-control form-control-sm text-right buying_price" name="buying_price[]"  value="0" readonly>
		</td>
		<td><i class="btn btn-danger fa fa-close removeeventmore"> </i></td>

	</tr>
</script>

<!-- extra_add_exist_item -->
<script type="text/javascript">
	$(document).ready(function () {
		$(document).on("click",".addeventmore", function () {
			var category_id  = $('#category_id').val();
			var category_name = $('#category_id').find('option:selected').text();
			var supplier_id  = $('#supplier_id').val();
			var supplier_name  = $('#supplier_id').find('option:selected').text();
			var product_id  = $('#product_id').val();
			var product_name  = $('#product_id').find('option:selected').text();
			var buying_qty  = $('#buying_qty').val();
			var buying_price  = $('#buying_price').val();
			var date  = $('#date').val();
			var purchase_no  = $('#purchase_no').val();
			var project_id  = $('#project_id').val();

			if(date==''){
				$.notify("Date is required", {globalPosition: 'top right',className: 'error'});
				return false;
			}
			if(purchase_no==''){
				$.notify("Purchase no is required", {globalPosition: 'top right',className: 'error'});
				return false;
			}
			if(project_id==''){
				$.notify("Project is required", {globalPosition: 'top right',className: 'error'});
				return false;
			}
			if(supplier_id==''){
				$.notify("Supplier is required", {globalPosition: 'top right',className: 'error'});
				return false;
			}
			if(category_id==''){
				$.notify("Category is required", {globalPosition: 'top right',className: 'error'});
				return false;
			}
			if(product_id==''){
				$.notify("Product is required", {globalPosition: 'top right',className: 'error'});
				return false;
			}

			var source = $("#document-template").html();
			var template = Handlebars.compile(source);
			var data= {buying_price:buying_price,purchase_no:purchase_no,project_id:project_id,supplier_id:supplier_id,category_id:category_id,category_name:category_name,product_id:product_id,product_name:product_name,supplier_name:supplier_name,buying_qty:buying_qty,date:date};
			var html = template(data);
			$("#addRow").append(html);
		});

		$(document).on("click", ".removeeventmore", function (event) {
			$(this).closest(".delete_add_more_item").remove();
			totalAmountPrice();
		});

		$(document).on('keyup click','.unit_price,.buying_qty',function(){
			var unit_price 	= $(this).closest("tr").find("input.unit_price").val();
			var qty 		= $(this).closest("tr").find("input.buying_qty").val();
			var total 		= unit_price * qty;
			$(this).closest("tr").find("input.buying_price").val(total);
			totalAmountPrice();
		});


		//calculate sum of amount in invoice
		function totalAmountPrice(){
			var sum=0;
			$(".buying_price").each(function(){
				var value = $(this).val();
				if(!isNaN(value) && value.length != 0) {
					sum += parseFloat(value);
				}
			});
			$('#estimated_amount').val(sum);
		}
	});
</script>

<script type="text/javascript">
	$(function(){
		$(document).on('change','#supplier_id',function(){
			var supplier_id = $(this).val();
			$.ajax({
				url:"{{route('get-product-category')}}",
				type:"GET",
				data:{supplier_id:supplier_id},
				success:function(data){
					var html = '<option value="">Select Category</option>';
					$.each( data, function( key, v ) {
						html +='<option value="'+v.category_id+'">'+v.category.name+'</option>';
					});
					$('#category_id').html(html);
				}
			});
		});
	});
</script>
<script type="text/javascript">
	$(function(){
		$(document).on('change','#category_id',function(){
			var category_id = $('#category_id').val();
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
				}
			});
		});
	});
</script>

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
