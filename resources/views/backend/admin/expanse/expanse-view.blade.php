@extends('backend.layouts.master')
@section('content')
<div class="content-page">
    
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
						<h2 class="main-title float-left">Manage Expense</h2>
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item">Home</li>
							<li class="breadcrumb-item">Expense</li>
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
							<h5>Expense List
								<a class="btn btn-sm btn-success float-right" href="{{route('expanses.expanse.add')}}"><i class="fa fa-plus-circle"></i> Add Expense</a>
							</h5>
						</div>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped dt-responsive" style="width: 100%">
								<thead>
									<tr>
										<th width="8%">S/L </th>
										<th>Expense Type</th>
										<th>Amount</th>
										<th>Date</th>
										<th>Details</th>
										<th>Status</th>
										<th width="17%">Action </th>
									</tr>
								</thead>
								<tbody>
									@foreach ($allData as $key => $expanse)
									<tr class="{{$expanse->id}}">
										<td>{{$key+1}}</td>
										<td>{{@$expanse['expanse_type']['name']}}</td>
										<td>{{$expanse->amount}}</td>
										<td>
											{{date('d-m-Y',strtotime($expanse->date))}}
										</td>
										<td>{{$expanse->details}}</td>
										<td>
											@if($expanse->status=='0')
											<span style="background: #FC463A;padding: 1px;">Pending</span>
											@elseif($expanse->status=='1')
											<span style="background: #1B9F5E;padding: 1px;">Approved</span>
											@endif
										</td>
										<td>
											@if($expanse->status=='0')
											<a class="btn btn-sm btn-primary" title="Edit" href="{{route('expanses.expanse.edit',$expanse->id)}}"><i class="fa fa-edit"></i></a>
											<a title="Delete" class="delete btn btn-sm btn-danger" href="{{ !empty($expanse->id) ? route('expanses.expanse.delete') : ''}}" data-token="{{ csrf_token() }}" data-id="{{ $expanse->id }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
											<a class="btn btn-sm btn-success" title="Approve" href="{{route('expanses.expanse.approve.get',$expanse->id)}}"><i class="fa fa-check-circle"></i></a>
											@endif
											<a class="btn btn-sm btn-info" title="attach" href="{{route('expanses.expanse.attach',$expanse->id)}}"><i class="fa fa-file"></i></a>
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