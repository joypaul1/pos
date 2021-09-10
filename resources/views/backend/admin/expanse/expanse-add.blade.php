@extends('backend.layouts.master')
@section('content')
<div class="content-page">
    
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
						<h2 class="main-title float-left">Manage Expense</h2>
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item">Home</li>
							<li class="breadcrumb-item">Expense</li>
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
							<h5>{{(@$editData) ? ("Update Expense") : "Add Expense"}}
								<a class="btn btn-sm btn-success float-right" href="{{route('expanses.expanse.view')}}"><i class="fa fa-list"></i> Expense List</a>
							</h5>
						</div>
						<div class="card-body">
							<form method="post" action="{{!empty($editData->id) ? route('expanses.expanse.update',$editData->id) : route('expanses.expanse.store')}}" id="myForm" enctype="multipart/form-data">
				            	{{csrf_field()}}
				            	<div class="form-row">
									<div class="form-group col-md-6">
										<label class="control-label">Expense Type <span style="color: red;">*</span></label>
										<select name="expanse_type_id" id="expanse_type_id" class="expanse_type_id form-control form-control-sm select2">
						                	<option value="">Select Expense Type</option>
						                	@foreach($expanse_types as $type)
						                	<option value="{{$type->id}}" {{(@$editData->expanse_type_id==$type->id)?"selected":""}}>{{$type->name}}</option>
						                	@endforeach
						                	<option value="0">Others</option>
						                </select>
									</div>
					              	<div class="form-group col-md-3">
						                <label>Amount</label>
						                <input type="number" name="amount" value="{{@$editData->amount}}" class="form-control form-control-sm" placeholder="Write Amount">
					              	</div>
					              	<div class="form-group col-md-3">
						                <label>Date</label>
						                <input type="text" name="date" value="{{(@$editData)?($editData->date):@$cdate}}" class="form-control form-control-sm singledatepicker" placeholder="YYYY-MM-DD" readonly>
					              	</div>
					            </div>
					            <div class="form-row">
					              	<div class="form-group col-md-4">
						                <label>File</label>
						                <input type="file" name="file" class="form-control form-control-sm">
					              	</div>
					              	<div class="form-group col-md-8">
						                <label>Details</label>
						                <input type="text" name="details" value="{{@$editData->details}}" class="form-control form-control-sm">
					              	</div>
					            </div>
					            <div class="form-row others_expanse_type" style="display: none; margin-bottom: 15px;">
									<div class="col-md-12">
										<input type="text" name="name" id="name" class=" form-control form-control-sm" placeholder="Write Expanse Type">
									</div>
								</div>
				            	<div class="form-row">
				              		<div class="form-group col-md-6">
				                		<button type="submit" class="btn btn-primary btn-sm">{{(@$editData) ? 'Update' : 'Submit'}}</button>
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

<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','.expanse_type_id',function(){
            var expanse_type_id = $(this).val();
            if(expanse_type_id == '0'){
                $('.others_expanse_type').show();
            }else{
                $('.others_expanse_type').hide();
            }
        });
    });
</script>
<script>
    $(document).ready(function(){
    	$('#myForm').validate({
    		ignore:[],
            errorPlacement: function(error, element){
                if (element.attr("name") == "project_id" ){ error.insertAfter(element.next()); }
                else if (element.attr("name") == "expanse_type_id" ){error.insertAfter(element.next()); }
                else{error.insertAfter(element);}
            },
    		errorClass:'text-danger',
	      	validClass:'text-success',
	        rules : {
	            expanse_type_id : {
	                required : true
	            },
	            amount : {
	                required : true
	            },
	            date : {
	                required : true
	            },
	        },
	        messages : {
	        	
	        }
	    });
    });
</script>

@endsection