@extends('backend.layouts.master')
@section('content')
<div class="content-page">

    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
						<h2 class="main-title float-left">Manage Due Invoice</h2>
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
							<h5>Due Invoice List
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
										<th width="15%">Action</th>
									</tr>
									@foreach($allData as $key =>  $value)
										<tr class="{{$value->id}}">
											<td>{{$key+1}}</td>

											<td>
												{{@$value['customer']['name']}} - {{@$value['customer']['mobile']}} ({{@$value['customer']['address']}})


											</td>
											<td> # {{@$value['invoice_no']}}</td>
											<td>{{date('d-m-Y',strtotime($value['date']))}}</td>
											<td>{{round($value->due_amount, 2)}} TK</td>
											<td>

											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
                        <div class="card-footer text-center">
                            <strong> Total Due Amount: {{ number_format($allData->sum('due_amount')??0, 2) }} Tk </strong>
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
