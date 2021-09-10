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
							<h5>Shop List
								@if($count < 1)
								<a class="btn btn-sm btn-success float-right" href="{{route('user.shop.add')}}"><i class="fa fa-plus-circle"></i> Shop Add</a>
								@endif
							</h5>
						</div>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped dt-responsive nowrap" style="width: 100%">
								<thead>
									<tr>
										<th>S/L </th>
										<th>Name</th>
										<th>Mobile</th>
										<th>Address</th>
										<th>Image</th>
										<th width="12%">Action </th>
									</tr>
								</thead>
								<tbody>
									@foreach ($allData as $key => $value)
									<tr class="{{$value->id}}">
										<td>{{$key+1}}</td>
										<td>{{$value->name}}</td>
										<td>{{$value->mobile}}</td>
										<td>{{$value->address}}</td>
										<td><img src="{{(!empty($value->image)) ? url('public/backend/user_images/'.$value->image) : url('public/backend/images/noimage.png')}}" style="height: 110px"></td>
										<td>
											<a class="btn btn-sm btn-info" title="Edit" href="{{route('user.shop.edit',$value->id)}}"><i class="fa fa-edit"></i></a>
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