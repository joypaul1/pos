@extends('backend.layouts.master')
@section('content')
<div class="content-page">
    
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
						<h2 class="main-title float-left">Manage Profile</h2>
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item">Home </li>
							<li class="breadcrumb-item active">Profile</li>
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
							<h5>
								@if(@$editData)
								Update Profile
								@else
								Add Profile
								@endif 
								{{-- <a class="btn btn-sm btn-success float-right" href=""><i class="fa fa-list"></i> User List</a> --}}
							</h5>
						</div>
						<div class="card-body">
							<form method="post" action="{{route('profile.user.update',$editData->id)}}" enctype="multipart/form-data" id="myForm">
				            	{{csrf_field()}}
				            	<div class="row">
					              	<div class="col-md-4">
						                <label for="name">Name</label>
						                <input type="text" name="name" class="form-control" value="{{ !empty($editData->name) ? $editData->name : old('name') }}">
					              	</div>
					              	<div class="col-md-4">
						                <label for="email">Email</label>
						                <input type="text" name="email" class="form-control" value="{{ !empty($editData->email) ? $editData->email : old('email') }}">
						                <font color="red">{{($errors->has('email')) ? ($errors->first('email')) : ''}}</font>
					              	</div>
					              	<div class="col-md-4">
					                	<label for="gender">Gender</label>
					                	<select name="gender" id="gender" class="form-control">
					                		<option value="">Select Gender</option>
					                		<option value="Male" {{(@$editData->gender=='Male') ? "selected" : ""}}>Male</option>
					                		<option value="Female" {{(@$editData->gender=='Female') ? "selected" : ""}}>Female</option>
					                	</select>
					              	</div>
					            </div><br/>
					            <div class="row">
					            	<div class="col-md-4">
						                <label for="mobile">Mobile No</label>
						                <input type="text" name="mobile" class="form-control" value="{{@$editData->mobile}}">
					              	</div>
					              	<div class="col-md-4">
						                <label for="address">Address</label>
						                <input type="text" name="address" class="form-control" value="{{@$editData->address}}">
					              	</div>
					            	<div class="col-md-4">
					            		<label for="image">Image</label>
					            		<input type="file" name="image" id="image" class="form-control">
					            	</div>
					            </div><br/>
					            <div class="row">
				            		<div class="col-md-2" style="padding-top: 25px">
				                		<input type="submit" value="update" class="btn btn-primary">
				              		</div>
					            	<div class="col-md-4">
					            		<img id="showImage" src="{{@$editData->image ? url('public/backend/user_images/'.$editData->image) : url('public/backend/images/noimage.png')}}" style="height: 100px; width: 100px; border: 1px solid black">
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
	        rules : {
	            role_id : {
	                required : true
	            },
	            name : {
	                required : true
	            },
	            email : {
	                required : true,
	                email : true
	            },
	        },
	        messages : {
	            role_id : {
	                required : '<font color="red"><b>Please Fill this field</b></font>'
	            },
	            name : {
	                required : '<font color="red"><b>Please Fill this field</b></font>'
	            },
	            email : {
	                required : '<font color="red"><b>Please Fill this field</b></font>',
	                email : '<font color="red"><b>Please enter a <em>valid</em> email address</b></font>'
	            },
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