@extends('backend.layouts.master')
@section('content')
<style type="text/css">
	.select2-container {
		width: 100% !important;
	}
</style>
<div class="content-page">
    
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
						<h2 class="main-title float-left">Manage date wise credit/paid</h2>
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item">Home</li>
							<li class="breadcrumb-item">credit/paid</li>
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
							<div class="form-row">
								<div class="form-group col-sm-12">
									<!-- Default inline 1-->
									<div class="custom-control custom-radio custom-control-inline">
									  <input type="radio" class="custom-control-input search_value" id="defaultInline1" name="inlineDefaultRadiosExample" value="credit_wise">
									  <label class="custom-control-label" for="defaultInline1">Date Wise Credit</label>
									</div>

									<!-- Default inline 2-->
									<div class="custom-control custom-radio custom-control-inline">
									  <input type="radio" class="custom-control-input search_value" id="defaultInline2" name="inlineDefaultRadiosExample" value="paid_wise">
									  <label class="custom-control-label" for="defaultInline2">Date  Wise Paid</label>
									</div>
								</div>
							</div>
							<div style="display: none;" class="show_supplier">
								<form method="GET" action="{{route('customers.customer.date-wise-credit')}}" id="supplierWiseForm" target="_blank">
									<div class="form-row">
										<div class="col-sm-4">
											<label>Start Date</label>
							                <input type="text" name="start_date" class="form-control form-control-sm singledatepicker" placeholder="YYYY-MM-DD" readonly>
										</div>
										<div class="col-sm-4">
											<label>End Date</label>
							                <input type="text" name="end_date" class="form-control form-control-sm singledatepicker" placeholder="YYYY-MM-DD" readonly>
										</div>
										<div class="col-sm-2" style="padding-top: 29px">
											<button type="submit" class="btn btn-primary btn-sm">Search</button>
										</div>
									</div>
								</form>
							</div>
							<div style="display: none;" class="show_product">
								<form method="GET" action="{{route('customers.customer.date-wise-paid')}}" id="productWiseForm" target="_blank">
									<div class="form-row">
										<div class="col-sm-4">
											<label>Start Date</label>
							                <input type="text" name="start_date" class="form-control form-control-sm singledatepicker" placeholder="YYYY-MM-DD" readonly>
										</div>
										<div class="col-sm-4">
											<label>End Date</label>
							                <input type="text" name="end_date" class="form-control form-control-sm singledatepicker" placeholder="YYYY-MM-DD" readonly>
										</div>
										<div class="form-group col-sm-2" style="padding-top: 29px;">
											<button type="submit" class="btn btn-primary btn-sm">Search</button>
										</div>
									</div>
								</form>
							</div>
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

{{-- Extra Others Field --}}
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','.search_value',function(){
            var search_value = $(this).val();
            if(search_value == 'credit_wise'){
                $('.show_supplier').show();
            }else{
                $('.show_supplier').hide();
            }
            if(search_value == 'paid_wise'){
                $('.show_product').show();
            }else{
                $('.show_product').hide();
            }
        });
    });
</script>

<script>
    $(document).ready(function(){
    	$('#supplierWiseForm').validate({
    		errorClass:'text-danger',
	      	validClass:'text-success',
	        rules : {
	            'start_date' : {
	                required : true,
	            },
	            'end_date' : {
	                required : true,
	            },
	        },
	        messages : {

	        }
	    });
    });
</script>

<script>
    $(document).ready(function(){
    	$('#productWiseForm').validate({
    		errorClass:'text-danger',
	      	validClass:'text-success',
	        rules : {
	            'start_date' : {
	                required : true,
	            },
	            'end_date' : {
	                required : true,
	            },
	        },
	        messages : {

	        }
	    });
    });
</script>

@endsection