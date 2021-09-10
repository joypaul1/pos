@extends('backend.layouts.master')
@section('content')
<div class="content-page">
    
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
						<h2 class="main-title float-left">Manage Due Purchase</h2>
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item">Home</li>
							<li class="breadcrumb-item">Purchase</li>
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
							<h5>Due Purchase List
							</h5>
						</div>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped dt-responsive table-responsive" style="width: 100%">
								<thead>
									<tr>
										<th>S/L </th>
										<th>Supplier Name</th>
										<th>Purchase No</th>
										<th>Date</th>
										<th width="5%">Amount</th>
										<th width="10%">Action </th>
									</tr>
								</thead>
								<tbody>
									@foreach ($allData as $key => $value)
									<tr class="{{$value->id}}">
										<td>{{$key+1}}</td>
										<td>
											{{@$value['supplier']['name']}} - {{@$value['supplier']['mobile']}} ({{@$value['supplier']['address']}})
										</td>
										<td># {{@$value['purchase']['purchase_no']}}</td>
										<td>{{date('d-m-Y',strtotime($value['purchase']['date']))}}</td>
										<td>{{round($value->due_amount, 2)}} Tk</td>
										<td>
											@if($value['purchase']['status']=='1')
											<a class="btn btn-sm btn-info" title="Edit" href="{{route('purchases.purchase.edit',$value->purchase_id)}}"><i class="fa fa-edit"></i></a>
											@endif
											<a class="btn btn-sm btn-success" target="_blank" title="detils" href="{{route('purchases.purchase.details',$value->purchase_id)}}"><i class="fa fa-eye"></i></a>
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