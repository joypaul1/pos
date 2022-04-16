@extends('backend.layouts.master')
@section('content')
<div class="content-page">

    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
						<h2 class="main-title float-left">Manage Customer</h2>
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item">Home</li>
							<li class="breadcrumb-item">Customer</li>
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
							<h5>Customer List
								<a class="btn btn-sm btn-success float-right" href="{{route('customers.customer.add')}}"><i class="fa fa-plus-circle"></i> Add Customer</a>
							</h5>
						</div>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped dt-responsive table-responsive" style="width: 100%">
								<thead>
									<tr>
										<th width="5%">S/L </th>
										<th>Customer Name</th>
										<th>Mobile</th>
										<th>Total Amount</th>
										<th>Payment</th>
										<th>Due</th>
										<th>Discount</th>
										<th>Service Charge</th>
										<th>Intertest Amount </th>
										<th width="10%">Action </th>
									</tr>
								</thead>
								<tbody>
									@foreach ($allData as $key => $value)
									<tr class="{{$value->id}}">
										<td>{{$key+1}}</td>
										<td>{{$value->name}}</td>
										<td>{{$value->mobile}}</td>
										<td>{{ number_format (optional($value->invoices)->sum('total_amount')??0, 2)}}</td>
										<td>{{ number_format (optional($value->invoices)->sum('paid_amount')??0, 2)}}</td>
										<td>{{ number_format (optional($value->invoices)->sum('due_amount')??0, 2)}}</td>
										<td>{{ number_format (optional($value->invoices)->sum('discount_amount')??0, 2)}}</td>
										<td>{{ number_format (optional($value->invoices)->sum('service_charge')??0, 2)}}</td>
										<td>{{ number_format (optional($value->invoices)->sum('intertest_amount')??0, 2)}}</td>
										<td>
											<a class="btn btn-sm btn-info" title="Edit" href="{{route('customers.customer.edit',$value->id)}}"><i class="fa fa-edit"></i></a>
											<a target="_blank" class="btn btn-sm btn-success" title="Details" href="{{route('customers.customer.details').'?customer_id='.$value->id}}"><i class="fa fa-eye"></i></a>
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
