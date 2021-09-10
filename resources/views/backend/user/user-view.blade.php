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
							<h5>User List
								<a class="btn btn-sm btn-success float-right" href="{{route('user.add')}}"><i class="fa fa-plus-circle"></i> Add User</a>
							</h5>
						</div>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped dt-responsive nowrap" style="width: 100%">
								<thead>
									<tr>
										<th>S/L </th>
										<th>User Type</th>
										<th>User Name</th>
										<th>Email</th>
										<th>Image</th>
										<th>Status</th>
										<th width="12%">Action </th>
									</tr>
								</thead>
								<tbody>
									@foreach ($users as $key => $user)
									<tr class="{{$user->id}}">
										<td>{{$key+1}}</td>
										<td>{{$user->usertype}}</td>
										<td>{{$user->name}}</td>
										<td>{{$user->email}}</td>
										<td><img src="{{(!empty($user->image)) ? url('public/backend/user_images/'.$user->image) : url('public/backend/images/noimage.png')}}" style="height: 110px"></td>
										<td>
											{{($user->status == "1") ? "Active" : "Inactive"}}
										</td>
										<td>
											@if($user->status==1)
                                            <a class="btn btn-primary btn-sm" href="{{ !empty($user->id) ? route('user.inactive',$user->id) : '' }}"><i class="fa fa-thumbs-up"></i></a>
                                            @else
                                            <a class="btn btn-danger btn-sm" href="{{ !empty($user->id) ? route('user.active',$user->id) : '' }}"><i class="fa fa-thumbs-down"></i></a>
                                            @endif
											<a class="btn btn-sm btn-info" title="Edit" href="{{route('user.edit',$user->id)}}"><i class="fa fa-edit"></i></a>
											<!-- <a href="{{ !empty($user->id) ? route('user.destroy') : ''}}"  class="delete btn btn-danger btn-sm deleteBtn"  data-token="{{ csrf_token() }}" data-id="{{ $user->id }}"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </a> -->
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
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