@extends('backend.layouts.master')
@section('content')
<div class="content-page">
    
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
						<h2 class="main-title float-left">Password Change</h2>
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item">Home </li>
							<li class="breadcrumb-item active">password</li>
						</ol>
						<div class="clearfix"></div>
					</div>
                </div>
            </div>
            <!-- end row -->
            
            <div class="container fullbody">
				<div class="col-md-5 offset-sm-3">
					<div class="card">
						<div class="card-header">
							{{-- <h5>
								
								<a class="btn btn-sm btn-success float-right" href=""><i class="fa fa-list"></i> Mission List</a>
							</h5> --}}
						</div>
						<form data-toggle="validator" id="myForm" role="form" method="post" action="{{route('profile.user.password.update')}}">  
							{{csrf_field()}}
							<input type="hidden" name="id" id="id" value="{{Auth::user()->id}}">							
							<div class="col-sm-12 form-group">
								<label class="control-label">Current Password</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="fa fa-unlock" aria-hidden="true"></i></span>
									</div>
									<input type="password" id="old_passowrd" data-minlength="6" name="old_passowrd" class="form-control" data-error="Password to short" placeholder="Current Password">
								</div>	
								<div class="help-block with-errors text-danger"></div>
								<font color="red">{{($errors->has('old_passowrd')) ? ($errors->first('old_passowrd')) : ''}}</font>
							</div>

							<div class="col-sm-12 form-group">
								<label class="control-label">New Password</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="fa fa-lock" aria-hidden="true"></i></span>
									</div>
									<input type="password" id="new_password" data-minlength="6" name="new_password" class="form-control" data-error="Password to short" placeholder="New Password">
								</div>	
								<div class="help-block with-errors text-danger"></div>
								<font color="red">{{($errors->has('new_password')) ? ($errors->first('new_password')) : ''}}</font>
							</div>

							<div class="form-group col-sm-12">
								<label class="control-label">Again New Password</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="fa fa-lock" aria-hidden="true"></i></span>
									</div>
									<input type="password" id="password_confirmation" data-minlength="6" name="password_confirmation" class="form-control" data-error="Password to short" placeholder="Again New Password">
								</div>	
								<div class="help-block with-errors text-danger"></div>
								<font color="red">{{($errors->has('password_confirmation')) ? ($errors->first('password_confirmation')) : ''}}</font>
							</div>

							<div class="form-group col-sm-12 offset-sm-4">
								<button type="submit" class="btn btn-success">Update</button>
							</div>
						</form>
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
		$('#myForm').validate({
			errorPlacement: function(error, element){
				if (element.attr("name") == "old_passowrd" ){ error.insertAfter(element.parent()); }
				else if (element.attr("name") == "new_password" ){error.insertAfter(element.parent()); }
				else if (element.attr("name") == "password_confirmation" ){error.insertAfter(element.parent()); }
				else{error.insertAfter(element);}
			},

			errorClass:'text-danger',
			validClass:'text-success',

			rules:{
				'old_passowrd':{
					required:true,
				},
				'new_password':{
					required:true,
				},
				'password_confirmation':{
					required:true,
					equalTo : '#new_password'
				},
			},
			messages:{
				'old_passowrd':'please enter current password',
				'new_password':'please enter new password',
				password_confirmation:{
					required:'please again enter new password',
					equalTo:'again password does not match!',
				},
			}
		});
	});
</script>

@endsection