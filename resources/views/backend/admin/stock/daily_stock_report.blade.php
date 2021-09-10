@extends('backend.layouts.master')
@section('content')
<div class="content-page">
    
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
						<h2 class="main-title float-left">Manage daily stock report</h2>
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item">Home</li>
							<li class="breadcrumb-item">daily stock</li>
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
							<h5>Select Criteria
						</div>

						<div class="card-body">
							<form method="POST" action="{{route('stocks.stock.report.pdf')}}" id="myForm" target="_blank">
								@csrf
								<div class="form-row">
									<div class="col-md-4">
						                <label>Supplier Name</label>
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
									<div class="form-group col-md-4">
										<label class="control-label">Product Name <span style="color: red;">*</span></label>
										<select name="product_id" id="product_id" class="form-control form-control-sm select2">
											<option value="">Select Product</option>

										</select>
									</div>
									<div class="col-md-4">
										<a class="btn btn-primary btn-sm" id="search"><i class="fa fa-search"></i> Search</a>
										<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-download"></i> Download</button>
									</div>
								</div>
							</form>
						</div>

						<div class="card-body">
			                <div id="DocumentResults"></div>
			                <script id="document-template" type="text/x-handlebars-template">
			                <table class="table-sm table-bordered table-striped dt-responsive" style="width: 100%">
			                    <thead>
			                        <tr>
										@{{{thsource}}}
			                        </tr>
			                    </thead>
			                    <tbody>
			                    	@{{{tdsource}}}
			                    </tbody>
			                </table>
			                </script>
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
<script type="text/javascript">
	$(document).ready(function () {
		$(document).on("click","#search", function () {
			var supplier_id  = $('#supplier_id').val();
			if(supplier_id==''){
				$.notify("Supplier is required", {globalPosition: 'top right',className: 'error'});
				return false;
			}
		});
	});
</script>

<script type="text/javascript">
	$(document).on('click','#search',function(){
		var supplier_id = $('#supplier_id').val();
		var category_id = $('#category_id').val();
		var product_id = $('#product_id').val();
		$.ajax({
			url: "{{route('stocks.stock.report.handlebar')}}",
			type: "get",
			data: {
				'supplier_id': supplier_id,
				'category_id': category_id,
				'product_id': product_id,
			},
			beforeSend: function() {
			},
			success: function (data) {
				var source = $("#document-template").html();
				var template = Handlebars.compile(source);
				var html = template(data);
				$('#DocumentResults').html(html);
				$('[data-toggle="tooltip"]').tooltip();
			}
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

@endsection