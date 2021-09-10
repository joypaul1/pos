@extends('backend.layouts.master')
@section('content')
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
						<h2 class="main-title float-left"><a href="{{route('user.list')}}">All User List</a></h2>
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item"><a class="btn btn-primary" href=""><i class="fa fa-edit"></i> Update User</a> </li>
						</ol>
						<div class="clearfix"></div>
					</div>
                </div>
            </div>
            <!-- end row -->
            
            <div class="container fullbody">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<form method="post" action="{{route('user.update',$editData->id)}}" enctype="multipart/form-data" id="myForm">
				            	{{csrf_field()}}
				            	<div class="row">
				              		<div class="col-md-4">
					                	<label for="role_id">User Role</label>
					                	<select name="role_id" id="role_id" class="form-control">
					                		<option value="">Select Role</option>
					                		@foreach($roles as $role)
				                    		<option value="{{ $role->id }}" {{(@$editData->role_id == $role->id) ? ('selected') : ''}}>{{ $role->role_name }}</option>
				                    		@endforeach
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
					            </div><br/>
					            <div class="row">
					            	<div class="col-md-4">
					            		<label for="image">Image</label>
					            		<input type="file" name="image" id="image" class="form-control">
					            	</div>
					            	<div class="col-md-4">
					            		<img id="showImage" src="{{@$editData->image ? url('public/backend/user_images/'.$editData->image) : url('public/backend/images/noimage.png')}}" style="height: 100px; width: 100px; border: 1px solid black">
					            	</div>
					            </div><br/>
				            	<div class="row">
				              		<div class="col-md-6">
				                		<input type="submit" value="update" class="btn btn-primary">
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
				status : {
					required : true
				}
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
				status : {
					required : '<font color="red"><b>Please Fill this field</b></font>'
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