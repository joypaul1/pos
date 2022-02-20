@extends('backend.layouts.master')
@section('content')
<div class="content-page">

    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
						<h2 class="main-title float-left">Manage Invoice</h2>
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item">Home</li>
							<li class="breadcrumb-item">Invoice</li>
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
							<h5>Invoice List
								<div class="btn-group float-right">
								  <a href="{{route('invoices.invoice.add')}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Add Invoice</a>
								</div>
							</h5>
						</div>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped dt-responsive table-responsive" style="width: 100%">
								<thead>
									<tr>
										<th width="5%">S/L </th>
										<th>Customer Info</th>
										<th>Invoice No</th>
										<th>Date</th>
										<th>Amount</th>
										<th>Status</th>
										<th width="17%">Action</th>
									</tr>
								</thead>
								<tbody>

									@foreach ($allData as $key => $value)
									<tr class="{{$value->id}}">
										<td>{{$key+1}}</td>
										<td>
											{{@$value['customer']['name']}}
                                            <br> M :
                                            {{@$value['customer']['mobile']}}
										</td>
										<td> # {{$value->invoice_no}}</td>
										<td>{{date('d-m-Y',strtotime($value->date))}}</td>
										<td>T.A. = {{round($value->total_amount, 2)}} TK
                                            <br> P. A = {{round($value->paid_amount, 2)}} TK
                                            <br> D. A = {{round($value->due_amount, 2)}} TK
                                        </td>
										<td>
											@if($value->status=='0')
											    <span style="background: #FC463A;padding: 1px;">Pending</span>
											@elseif($value->status=='2')
											    <span style="background: #FC463A;padding: 1px;">Pending</span>
											@elseif($value->status=='1')
											    <span style="background: #1B9F5E;padding: 1px;">Approved</span>
											@endif
										</td>
										<td>
                                            @if($value->due_amount > 0 )
                                            <a class="btn btn-sm btn-warning" title="Edit" href="{{route('invoices.invoice.edit',$value->id)}}"><i class="fa fa-pencil"></i></a>
                                            @endif
											@if($value->status=='0')
											<a class="btn btn-sm btn-info" title="Approve" href="{{route('invoices.invoice.approve-get',$value->id)}}"><i class="fa fa-check-circle"></i></a>
											<a title="Delete" href="{{ !empty($value->id) ? route('invoices.invoice.destroy') : ''}}"  class="delete btn btn-danger btn-sm deleteBtn"  data-token="{{ csrf_token() }}"
                                                data-id="{{ $value->id }}"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </a>
                                            @endif
                                            @if($value->status=='2')
                                            <a class="btn btn-sm btn-info" title="Approve" href="{{route('invoices.invoice.approve-get',$value->id)}}"><i class="fa fa-check-circle"></i></a>
                                            @endif


                                            <a target="_blank" class="btn btn-sm btn-success" title="others print" href="{{route('invoices.invoice.othersPdf',$value->id)}}"> All <i class="fa fa-print"></i></a>


                                             <a target="_blank" class="btn btn-sm btn-success" title="others print 1" href="{{route('invoices.invoice.pdfa',$value->id)}}"> S <i class="fa fa-print"></i></a>

                                             <a target="_blank" class="btn btn-sm btn-success" title="Print" href="{{route('invoices.invoice.pdf',$value->id)}}"> P <i class="fa fa-print"></i></a>
                                             <a target="_blank" class="btn btn-sm btn-info" title="Bank Print" href="{{route('invoices.invoice.bankpdf',$value->id)}}"> Bank <i class="fa fa-print"></i></a>



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
