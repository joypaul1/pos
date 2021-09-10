@extends('backend.layouts.master')
@section('content')
<div class="content-page">
    
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
						<h2 class="main-title float-left">Manage Shop</h2>
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item">Home</li>
							<li class="breadcrumb-item">Shop</li>
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
							<h5>{{(@$editData) ? ("Update Shop") : "Add Shop"}}
								<a class="btn btn-sm btn-success float-right" href="{{route('user.shop.view')}}"><i class="fa fa-list"></i> Shop List</a>
							</h5>
						</div>
						<div class="card-body">
							<form method="post" action="{{!empty($editData->id) ? route('user.shop.update',$editData->id) : route('user.shop.store')}}" enctype="multipart/form-data" id="myForm">
				            	{{csrf_field()}}
				            	<div class="row">
					              	<div class="col-md-6">
						                <label for="name">Name</label>
						                <input type="text" name="name" class="form-control" value="{{@$editData->name}}">
					              	</div>
					              	<div class="col-md-6">
						                <label for="mobile">Mobile</label>
						                <input type="text" name="mobile" class="form-control" value="{{@$editData->mobile}}">
					              	</div>
					              	<div class="col-md-6">
						                <label for="address">Address</label>
						                <input type="text" name="address" class="form-control" value="{{@$editData->address}}">
					              	</div>
					            	<div class="col-md-4">
					            		<label for="image">Logo <span style="color:red">(Size:80px X 60px)</span></label>
					            		<input type="file" name="image" id="image" class="form-control">
					            	</div>
					            	<div class="col-md-2" style="padding-top: 12px;">
					            		<img id="showImage" src="{{@$editData->image ? url('public/backend/user_images/'.$editData->image) : url('public/backend/images/noimage.png')}}" style="height: 100px; width: 100px; border: 1px solid black">
					            	</div>
					            </div>
				            	<div class="row">
				              		<div class="col-md-6">
				              			<button class="btn btn-primary">{{(@$editData) ? ("Update") : "Submit"}}</button>
				                		<!-- <input type="submit" value="submit" class="btn btn-primary"> -->
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

		$('#image').change(function (e) { //show Slider Image before upload
	    	var reader = new FileReader();
	    	reader.onload = function (e) {
	    		$('#showImage').attr('src', e.target.result);
	    	};
	    	reader.readAsDataURL(e.target.files[0]);
	    });
	});
</script>

@endsection