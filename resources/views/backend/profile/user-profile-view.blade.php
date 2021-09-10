@extends('backend.layouts.master')
@section('content')
<style type="text/css">
.emp-profile{
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff;
}
.profile-img{
    text-align: center;
}
/*.profile-img img{
    width: 70%;
    height: 100%;
}*/
.profile-img .file {
    position: relative;
    overflow: hidden;
    margin-top: -20%;
    width: 70%;
    border: none;
    border-radius: 0;
    font-size: 15px;
    background: #212529b8;
}

.profile-head h5{
    color: #333;
}
.profile-head h6{
    color: #0062cc;
}
.profile-edit-btn{
    border: none;
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
    padding: 10px;
    cursor: pointer;
}
.proile-rating{
    font-size: 12px;
    color: #818182;
    margin-top: 5%;
}
.proile-rating span{
    color: #495057;
    font-size: 15px;
    font-weight: 600;
}
.profile-head .nav-tabs{
    margin-bottom:5%;
}
.profile-head .nav-tabs .nav-link{
    font-weight:600;
    border: none;
}
.profile-head .nav-tabs .nav-link.active{
    border: none;
    border-bottom:2px solid #0062cc;
}
.profile-work{
    padding: 14%;
    margin-top: -15%;
}
.profile-work p{
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
}
.profile-work a{
    text-decoration: none;
    color: #495057;
    font-weight: 600;
    font-size: 14px;
}
.profile-work ul{
    list-style: none;
}
.profile-tab label{
    font-weight: 600;
}
.profile-tab p{
    font-weight: 600;
    color: #0062cc;
}
</style>
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
						{{-- <div class="card-header">
							<h5>Mission List <a class="btn btn-sm btn-success float-right" href=""><i class="fa fa-plus-circle"></i> Add Mission</a></h5>
						</div> --}}
						<div class="card-body">
							<div class="container emp-profile">
					            <form method="post">
					                <div class="row">
					                    <div class="col-md-4">
					                        <div class="profile-img">
					                            <img src="{{@$user->image ? url('public/backend/user_images/'.$user->image) : url('public/backend/images/noimage.png')}}"style="border-radius: 50%; height: 200px; width: 200px">
					                        </div>
					                    </div>
					                    <div class="col-md-6">
					                        <div class="profile-head">
			                                    <h5>
			                                        {{@$user->name}}
			                                    </h5>
			                                    <h6>
			                                        {{@$user->mobile}}
			                                    </h6>
			                                    <p class="proile-rating" style="font-size: 17px;">Address : <span>{{$user->address}}</span></p>
					                            <ul class="nav nav-tabs" id="myTab" role="tablist">
					                                <li class="nav-item">
					                                	
					                                </li>
					                            </ul>
					                        </div>
					                    </div>
					                    <div class="col-md-2">
			                                <a class="profile-edit-btn btn-primary" href="{{ !empty($user->id) ? route('profile.user.edit',$user->id) : '' }}"> Edit Profile </a>
					                    </div>
					                </div>
					                <div class="row">
					                    <div class="col-md-4">
					                        <div class="profile-work">
					                            <!-- <p>My Profile</p>
					                            <a href="">Website Link</a><br/>
					                            <a href="">Bootsnipp Profile</a><br/>
					                            <a href="">Bootply Profile</a> -->
					                        </div>
					                    </div>
					                    <div class="col-md-8">
					                        <div class="tab-content profile-tab" id="myTabContent">
					                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
			                                        <div class="row">
			                                            <div class="col-md-6">
			                                                <label>Name</label>
			                                            </div>
			                                            <div class="col-md-6">
			                                                <p>{{$user->name}}</p>
			                                            </div>
			                                        </div>
			                                        <div class="row">
			                                            <div class="col-md-6">
			                                                <label>Email</label>
			                                            </div>
			                                            <div class="col-md-6">
			                                                <p>{{$user->email}}</p>
			                                            </div>
			                                        </div>
			                                        <div class="row">
			                                            <div class="col-md-6">
			                                                <label>Mobile No</label>
			                                            </div>
			                                            <div class="col-md-6">
			                                                <p>{{$user->mobile}}</p>
			                                            </div>
			                                        </div>
			                                        <div class="row">
			                                            <div class="col-md-6">
			                                                <label>Gender</label>
			                                            </div>
			                                            <div class="col-md-6">
			                                                <p>{{$user->gender}}</p>
			                                            </div>
			                                        </div>
			                                        <div class="row">
			                                            <div class="col-md-6">
			                                                <label>Address</label>
			                                            </div>
			                                            <div class="col-md-6">
			                                                <p>{{$user->address}}</p>
			                                            </div>
			                                        </div>
					                            </div>
					                        </div>
					                    </div>
					                </div>
					            </form>           
					        </div>
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

@endsection