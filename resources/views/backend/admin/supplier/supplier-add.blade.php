@extends('backend.layouts.master')
@section('content')
<div class="content-page">
    
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
						<h2 class="main-title float-left">Manage Supplier</h2>
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item">Home</li>
							<li class="breadcrumb-item">Supplier</li>
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
							<h5>{{(@$editData) ? ("Update Supplier") : "Add Supplier"}}
								<a class="btn btn-sm btn-success float-right" href="{{route('suppliers.supplier.view')}}"><i class="fa fa-list"></i> Supplier List</a>
							</h5>
						</div>
						<div class="card-body">
							<form method="post" action="{{!empty($editData->id) ? route('suppliers.supplier.update',$editData->id) : route('suppliers.supplier.store')}}" id="myForm" enctype="multipart/form-data">
				            	{{csrf_field()}}
				            	<div class="form-row">
					            	<div class="form-group col-md-6">
						                <label>Supplier Name</label>
						                <input type="text" name="name" class="form-control" value="{{@$editData->name}}" placeholder="Write Name">
					              	</div>
					              	<div class="form-group col-md-6">
						                <label>Mobile No</label>
						                <input type="text" name="mobile" class="form-control" value="{{@$editData->mobile}}" placeholder="Write Mobile No">
					              	</div>
					              	<div class="form-group col-md-6">
						                <label>Email</label>
						                <input type="email" name="email" class="form-control" value="{{@$editData->email}}" placeholder="Write Email">
					              	</div>
					              	<div class="form-group col-md-6">
						                <label>Address</label>
						                <input type="text" name="address" class="form-control" value="{{@$editData->address}}" placeholder="Write Address">
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
	            },
	            mobile : {
	                required : true
	            },
	            address : {
	                required : true
	            }
	        },
	        messages : {
	        	
	        }
	    });
    });
</script>

@endsection