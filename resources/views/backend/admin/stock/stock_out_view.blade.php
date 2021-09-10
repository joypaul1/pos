@extends('backend.layouts.master')
@section('content')
<div class="content-page">
    
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
						<h2 class="main-title float-left">Manage Stock Out</h2>
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item">Home</li>
							<li class="breadcrumb-item">Stock </li>
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
							<h5>Stock Out List
								<a class="btn btn-sm btn-success float-right" href="{{route('stocks.stock.add')}}"><i class="fa fa-plus-circle"></i> Add Stock Out</a>
							</h5>
						</div>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped dt-responsive table-responsive" style="width: 100%">
								<thead>
									<tr>
										<th width="5%">S/L </th>
										<th>Invoice No</th>
										<th>Date</th>
										<th>Status</th>
										<th width="15%">Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($allData as $key => $value)
									<tr>
										<td>{{$key+1}}</td>
										<td># {{$value->stock_invoice_no}}</td>
										<td>{{date('d-m-Y',strtotime($value->date))}}</td>
										<td>
											@if($value->status=='0')
											<span style="background: #FC463A;padding: 1px;">Pending</span>
											@elseif($value->status=='1')
											<span style="background: #1B9F5E;padding: 1px;">Approved</span>
											@endif
										</td>
										<td>
											@if($value->status=='0')
											<a class="btn btn-sm btn-info" title="Approve" href="{{route('stocks.stock.approve',$value->id)}}"><i class="fa fa-check-circle"></i></a>
											<a title="Delete" href="{{ !empty($value->id) ? route('stocks.stock.destroy') : ''}}"  class="delete btn btn-danger btn-sm deleteBtn"  data-token="{{ csrf_token() }}" data-id="{{ $value->id }}"><i class="fa fa-trash-o" aria-hidden="true"></i>
										    </a>
										    @endif
										    <a target="_blank" class="btn btn-sm btn-success" title="Print" href="{{route('stocks.stock.pdf',$value->id)}}"><i class="fa fa-print"></i></a>
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