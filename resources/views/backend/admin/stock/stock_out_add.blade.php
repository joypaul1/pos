@extends('backend.layouts.master')
@section('content')
<div class="content-page">
    
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
						<h2 class="main-title float-left">Manage Stock</h2>
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item">Home</li>
							<li class="breadcrumb-item">Stock</li>
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
							<h5>{{(@$editData) ? ("Update Stock Out") : "Add Stock Out"}}
								<a class="btn btn-sm btn-success float-right" href="{{route('stocks.stock.view')}}"><i class="fa fa-list"></i> Stock Out List</a>
							</h5>
						</div>

						<div class="card-body">
							<form>
								<div class="form-row">
									<div class="form-group col-md-3">
										<label class="control-label">Date <span style="color: red;">*</span></label>
										<input type="text" name="date" id="date" class="form-control form-control-sm singledatepicker" value="{{@$cdate}}" placeholder="YYYY-MM-DD" autocomplete="off" readonly>
									</div>
									<div class="form-group col-md-3">
										<label class="control-label">Invoice No <span style="color: red;">*</span></label>
										<input type="text" name="stock_invoice_no" id="stock_invoice_no" class="form-control form-control-sm" value="{{$stock_invoice_no}}" readonly>
									</div>
									<div class="form-group col-md-3">
										<label class="control-label">Stock out Reason <span style="color: red;">*</span></label>
										<select name="reason_id" id="reason_id" class="form-control form-control-sm select2">
											<option value="">Select Reason</option>
											@foreach($reasons as $reason)
						                	<option value="{{$reason->id}}">{{$reason->name}}</option>
						                	@endforeach
										</select>
									</div>
									<div class="form-group col-md-3">
										<label class="control-label">Supplier <span style="color: red;">*</span></label>
										<select name="supplier_id" id="supplier_id" class="form-control form-control-sm select2">
						                	<option value="">Select Supplier</option>
						                	@foreach($suppliers as $supplier)
						                	<option value="{{$supplier->id}}">{{$supplier->name}}</option>
						                	@endforeach
						                </select>
									</div>
									<div class="form-group col-md-3">
										<label class="control-label">Category <span style="color: red;">*</span></label>
										<select name="category_id" id="category_id" class="category_id form-control form-control-sm select2">
											<option value="">Select Category</option>
										</select>
									</div>
									<div class="form-group col-md-5">
										<label class="control-label">Product Name <span style="color: red;">*</span></label>
										<select name="product_id" id="product_id" class="form-control form-control-sm select2">
											<option value="">Select Product</option>

										</select>
									</div>
									<div class="form-group col-md-2">
										<label class="control-label">Current Stock <span style="color: red;">*</span></label>
										<input type="text" id="current_stock" class="form-control form-control-sm" readonly>
									</div>
									<div class="form-group col-md-1" style="padding-top: 29px;">
										<i class="btn btn-primary fa fa-plus-circle addeventmore"> Add</i>
									</div>
								</div>
							</form>
						</div>

						<div class="card border-info">
							<form method="post" action="{{route('stocks.stock.store')}}" id="myForm">
								{{csrf_field()}}
								<div class="card-body">
									<table class="table-sm table-bordered" width="100%">
										<thead>
											<tr>
												<th>Reason</th>
												<th>Product Name</th>
												<th width="10%">Qty</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody id="addRow" class="addRow">

										</tbody>
									</table>
									<br>
									<div class="form-group">
										<button type="submit" class="btn btn-sm btn-primary" id="storeButton">Stock Out</button>
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
		<input type="hidden" name="stock_invoice_no" value="@{{stock_invoice_no}}">
		<input type="hidden" name="reason_id[]" value="@{{reason_id}}">
		<input type="hidden" name="supplier_id[]" value="@{{supplier_id}}">
		<td>
			<input type="hidden" name="category_id[]" value="@{{category_id}}">
			@{{reason_name}}
		</td>
		<td>
			<input type="hidden" name="product_id[]" value="@{{product_id}}">
			@{{product_name}}
		</td>

		<td>
			<input type="number" min="1" class="form-control form-control-sm text-right quantity" name="quantity[]"  value="1">
		</td>
		<td><i class="btn btn-danger fa fa-close removeeventmore"> </i></td>

	</tr>
</script>

<!-- extra_add_exist_item -->
<script type="text/javascript">
	$(document).ready(function () {
		$(document).on("click",".addeventmore", function () {
			var category_id  = $('#category_id').val();
			var supplier_id  = $('#supplier_id').val();
			var supplier_name  = $('#supplier_id').find('option:selected').text();
			var product_id  = $('#product_id').val();
			var product_name  = $('#product_id').find('option:selected').text();
			var quantity  = $('#quantity').val();
			var date  = $('#date').val();
			var stock_invoice_no  = $('#stock_invoice_no').val();
			var reason_id  = $('#reason_id').val();
			var reason_name = $('#reason_id').find('option:selected').text();

			if(date==''){
				$.notify("Date is required", {globalPosition: 'top right',className: 'error'});
				return false;
			}
			if(stock_invoice_no==''){
				$.notify("Purchase no is required", {globalPosition: 'top right',className: 'error'});
				return false;
			}
			if(reason_id==''){
				$.notify("Reason is required", {globalPosition: 'top right',className: 'error'});
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
			var data= {stock_invoice_no:stock_invoice_no,reason_id:reason_id,supplier_id:supplier_id,category_id:category_id,reason_name:reason_name,product_id:product_id,product_name:product_name,supplier_name:supplier_name,quantity:quantity,date:date};
			var html = template(data);
			$("#addRow").append(html);
		});
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
	$(function(){
		$(document).on('change','#product_id',function(){
			var product_id = $('#product_id').val();
			$.ajax({
				url:"{{route('get-product-stock')}}",
				type:"GET",
				data:{'product_id':product_id},
				success:function(data){
	                $('#current_stock').val(data);
				}
			});
		});
	});
</script>

@endsection