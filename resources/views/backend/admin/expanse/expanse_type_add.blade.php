@extends('backend.layouts.master')
@section('content')
<div class="content-page">
    
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
						<h2 class="main-title float-left">Manage Expense Type</h2>
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item">Home</li>
							<li class="breadcrumb-item">Expense Type</li>
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
							<h5>{{(@$editData) ? ("Update Expense Type") : "Add Expense Type"}}
								<a class="btn btn-sm btn-success float-right" href="{{route('expanses.type.view')}}"><i class="fa fa-list"></i> Expense Type List</a>
							</h5>
						</div>
						<div class="card-body">
							<form method="post" action="{{!empty($editData->id) ? route('expanses.type.update',$editData->id) : route('expanses.type.store')}}" id="myForm" enctype="multipart/form-data">
				            	{{csrf_field()}}
				            	<div class="form-row">
					            	<div class="form-group col-md-6">
						                <label>Expense Type</label>
						                <input type="text" name="name" class="form-control" value="{{@$editData->name}}" placeholder="Write Expense Type">
						                <font color="red">{{($errors->has('name'))?($errors->first('name')):''}}</font>
					              	</div>
					            </div>
				            	<div class="form-row">
				              		<div class="form-group col-md-6">
				                		<button type="submit" class="btn btn-primary">{{(@$editData) ? 'Update' : 'Submit'}}</button>
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
<script>
    $(document).ready(function(){
    	$('#myForm').validate({
    		errorClass:'text-danger',
	      	validClass:'text-success',
	        rules : {
	            name : {
	                required : true
	            }
	        },
	        messages : {
	        	
	        }
	    });
    });
</script>

@endsection