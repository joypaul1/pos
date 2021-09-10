@extends('backend.layouts.master')
@section('content')
<div class="content-page">
    
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
						<h2 class="main-title float-left">Manage Category</h2>
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item">Home</li>
							<li class="breadcrumb-item">Category</li>
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
							<h5>{{(@$editData) ? ("Update Category") : "Add Category"}}
								<a class="btn btn-sm btn-success float-right" href="{{route('categories.category.view')}}"><i class="fa fa-list"></i> Category List</a>
							</h5>
						</div>
						<div class="card-body">
							<form method="post" action="{{!empty($editData->id) ? route('categories.category.update',$editData->id) : route('categories.category.store')}}" id="myForm" enctype="multipart/form-data">
				            	{{csrf_field()}}
				            	<div class="form-row">
					            	<div class="form-group col-md-6">
						                <label>Category Name</label>
						                <input type="text" name="name" class="form-control" value="{{@$editData->name}}" placeholder="Write Name">
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