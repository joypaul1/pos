@extends('backend.layouts.master')
@section('content')
<div class="content-page">
    
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
						<h2 class="main-title float-left">Manage daily Sales report</h2>
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item">Home</li>
							<li class="breadcrumb-item">daily Sales</li>
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
							<form method="POST" action="{{route('invoices.invoice.date.wise.pdf')}}" id="myForm" target="_blank">
								@csrf
								<div class="form-row">
									<div class="col-md-3">
						                <label>Customer Name</label>
						                <select name="customer_id" id="customer_id" class="form-control form-control-sm select2">
						                	<option value="">Select Customer</option>
						                	@foreach($customers as $customer)
						                	<option value="{{$customer->id}}">{{$customer->name}}</option>
						                	@endforeach
						                </select>
					              	</div>
									<div class="col-md-3">
										<label>Start Date</label>
						                <input type="text" name="start_date" id="start_date" class="form-control form-control-sm singledatepicker" placeholder="YYYY-MM-DD" readonly>
									</div>
									<div class="col-md-3">
										<label>End Date</label>
						                <input type="text" name="end_date" id="end_date" class="form-control form-control-sm singledatepicker" placeholder="YYYY-MM-DD" readonly>
									</div>
									<div class="col-md-3" style="padding-top:30px;">
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
	$("#myForm").submit(function( event ) {
		var start_date = $('#start_date').val();
		var end_date = $('#end_date').val();
		if (start_date == ''){
			$('.notifyjs-corner').html('');
			$.notify("Start Date is required", {globalPosition: 'top right',className: 'error'});
			event.preventDefault();
		}else{
			return true;
		}
		if (end_date == ''){
			$('.notifyjs-corner').html('');
			$.notify("End Date is required", {globalPosition: 'top right',className: 'error'});
			event.preventDefault();
		}else{
			return true;
		}
	});
</script>

<script type="text/javascript">
	$(document).ready(function () {
		$(document).on("click","#search", function () {
			var start_date = $('#start_date').val();
			var end_date = $('#end_date').val();
			if(start_date==''){
				$.notify("Start Date is required", {globalPosition: 'top right',className: 'error'});
				return false;
			}
			if(end_date==''){
				$.notify("End Date is required", {globalPosition: 'top right',className: 'error'});
				return false;
			}
		});
	});
</script>

<script type="text/javascript">
	$(document).on('click','#search',function(){
		var customer_id = $('#customer_id').val();
		var start_date = $('#start_date').val();
		var end_date = $('#end_date').val();
		$.ajax({
			url: "{{route('invoices.invoice.date.wise.handlebar')}}",
			type: "get",
			data: {
				'customer_id': customer_id,
				'start_date': start_date,
				'end_date': end_date,
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

@endsection