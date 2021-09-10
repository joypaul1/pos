@extends('backend.layouts.master')
@section('content')
<div class="content-page">
    
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
						<h2 class="main-title float-left">Manage User</h2>
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item">Home</li>
							<li class="breadcrumb-item">User</li>
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
							<h5>{{(@$editData) ? ("Update User") : "Add User"}}
								<a class="btn btn-sm btn-success float-right" href="{{route('user.view')}}"><i class="fa fa-list"></i> User List</a>
							</h5>
						</div>
						<div class="card-body">
							<form method="post" action="{{(!empty($editData->id) ? route('user.update',$editData->id) : route('user.store'))}}" enctype="multipart/form-data" id="myForm">
				            	{{csrf_field()}}
				            	<div class="row">
				              		<div class="col-md-4">
					                	<label for="usertype">User Role</label>
					                	<select name="usertype" id="usertype" class="form-control">
					                		<option value="">Select Role</option>
					                		<option value="Admin" {{(@$editData->usertype=='Admin') ? "selected" : ""}}>Admin</option>
					                		<option value="Computer Operator" {{(@$editData->usertype=='Computer Operator') ? "selected" : ""}}>Computer Operator</option>
					                	</select>
					              	</div>
					              	<div class="col-md-4">
						                <label for="name">Name</label>
						                <input type="text" name="name" class="form-control" value="{{ !empty($editData->name) ? $editData->name : old('name') }}">
					              	</div>
					              	<div class="col-md-4">
						                <label for="email">Email</label>
						                <input type="text" name="email" class="form-control" value="{{ !empty($editData->email) ? $editData->email : old('email') }}">
						                <font color="red">{{($errors->has('email')) ? ($errors->first('email')) : ''}}</font>
					              	</div>
					              	@if(!@$editData)
					            	<div class="col-md-4">
					            		<label for="password">Password</label>
					            		<input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}">
					            	</div>
					            	<div class="col-md-4">
					            		<label for="password">Confirm Password</label>
					            		<input type="password" name="password2" class="form-control" value="{{ old('password') }}">
					            	</div>
					            	@endif
					            	<div class="col-md-4">
					            		<label for="image">Image</label>
					            		<input type="file" name="image" id="image" class="form-control">
					            	</div>
					            	<div class="col-md-4" style="padding-top: 12px;">
					            		<img id="showImage" src="{{@$editData->image ? url('public/backend/user_images/'.$editData->image) : url('public/backend/images/noimage.png')}}" style="height: 100px; width: 100px; border: 1px solid black">
					            	</div>
					            </div><br/>
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
	            usertype : {
	                required : true
	            },
	            name : {
	                required : true
	            },
	            email : {
	                required : true,
	                email : true
	            },
	            password : {
					required : true,
					minlength : 6
				},
				password2 : {
					required : true,
					equalTo : '#password'
				},
				status : {
					required : true
				}
	        },
	        messages : {
	            usertype : 'Please select Role',
	            name : 'Please enter your name',
	            email : {
	                required : 'Please enter email address',
	                email : 'Please enter a <em>valid</em> email address',
	            },
	            password : {
					required : 'Please enter password',
					minlength : 'Password will be minimum 6 characters or numbers',
				},
				password2 : {
					required : 'Please enter confirm password',
					equalTo : 'Confirm password does not match',
				},
				status : {
					required : 'Please select status'
				}
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