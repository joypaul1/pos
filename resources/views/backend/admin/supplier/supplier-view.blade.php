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
							<h5>Supplier List
								<a class="btn btn-sm btn-success float-right" href="{{route('suppliers.supplier.add')}}"><i class="fa fa-plus-circle"></i> Add Supplier</a>
							</h5>
						</div>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped dt-responsive table-responsive" style="width: 100%">
								<thead>
									<tr>
										<th width="4%">S/L </th>
										<th>Supplier Name</th>
										<th>Mobile</th>
										<th>Email</th>
										<th>Address</th>
										<th>Total Amount</th>
										<th>Payment</th>
										<th>Due</th>
										<th width="15%">Action </th>
									</tr>
								</thead>
								<tbody>
									@foreach ($allData as $key => $supplier)
									<tr class="{{$supplier->id}}">
										<td>{{$key+1}}</td>
										<td>{{$supplier->name}}</td>
										<td>{{$supplier->mobile}}</td>
										<td>{{$supplier->email}}</td>
										<td>{{$supplier->address}}</td>
										<td>{{$supplier->total_amount}} TK</td>
										<td>{{$supplier->payment}} TK</td>
										<td>{{$supplier->due}} TK</td>
										<td>
											<a class="btn btn-sm btn-info" title="Edit" href="{{route('suppliers.supplier.edit',$supplier->id)}}"><i class="fa fa-edit"></i></a>
											<a target="_blank" class="btn btn-sm btn-success" title="Details" href="{{route('suppliers.supplier.details',$supplier->id)}}"><i class="fa fa-eye"></i></a>
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