@extends('backend.layouts.master')
@section('content')
<div class="content-page">
    
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
						<h2 class="main-title float-left">Manage Supplier Report</h2>
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item">Home</li>
							<li class="breadcrumb-item">Report</li>
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
							<form method="POST" action="{{route('suppliers.supplier.report.pdf')}}" id="myForm" target="_blank">
								@csrf
								<div class="form-row">
									<div class="col-md-4">
						                <label>Supplier Name</label>
						                <select name="supplier_id" id="supplier_id" class="form-control form-control-sm">
						                	<option value="">Select Supplier</option>
						                	@foreach($suppliers as $supplier)
						                	<option value="{{$supplier->id}}">{{$supplier->name}}</option>
						                	@endforeach
						                </select>
					              	</div>
									<div class="col-md-4" style="padding-top: 30px;">
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
	$("#myForm").submit(function( event ) {
		var supplier_id = $('#supplier_id').val();
		if (supplier_id == ''){
			$('.notifyjs-corner').html('');
			$.notify("Supplier Name is required", {globalPosition: 'top right',className: 'error'});
			event.preventDefault();
		}else{
			return true;
		}
	});
</script>

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
		$.ajax({
			url: "{{route('suppliers.supplier.report.handlebar')}}",
			type: "get",
			data: {
				'supplier_id': supplier_id,
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