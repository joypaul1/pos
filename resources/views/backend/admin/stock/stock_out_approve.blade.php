@extends('backend.layouts.master')
@section('content')
<style type="text/css">
	tr th{
		padding: 3px;
	}
	tr td{
		padding: 1px 3px 1px 3px;
	}
</style>
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
							<li class="breadcrumb-item">Stock Out</li>
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
							<h5>Stock Out Approval (Invoice No:#{{$stock_invoice->stock_invoice_no}}) Date: {{date('d-m-Y',strtotime($stock_invoice->date))}}
								<a class="btn btn-sm btn-success float-right" href="{{route('stocks.stock.view')}}"><i class="fa fa-list"></i> Stock Out List</a>
							</h5>
						</div>
						<form method="post" action="{{route('stocks.stock.approve.store',$stock_invoice->id)}}" id="myForm">
							@csrf
							<div class="card-body">
						        <table class="table table-bordered table-striped" style="margin-bottom: 5px;">
						          <thead>
						            <tr>
						              <th width="5%">SL</th>
						              <th>Stock Out Reason</th>
						              <th>Category</th>
						              <th>Product Name</th>
						              <th class="text-center" style="background: #1B9F5E;padding: 1px; color: #fff;">Current Stock</th>
						              <td>Issu Quantity</td>
						            </tr>
						          </thead>
						          <tbody>
						          	@php
						          		$product_sale_sum = 0;
						          	@endphp
						          	@foreach($stock_invoice['stock_out_details'] as $key => $details)

                                    @php
                                        $buying_qty =  App\Model\PurchaseDetail::where('product_id',$details->product_id)->where('status','1')->sum('buying_qty');
                                        $buying_free_qty =  App\Model\PurchaseDetail::where('product_id',$details->product_id)->where('status','1')->sum('free_quantity');
                                        $total_in_qty = $buying_qty+$buying_free_qty;
                                        $selling_qty = App\Model\InvoiceDetail::where('product_id',$details->product_id)->where('status','1')->sum('selling_qty');
                                        $selling_free_qty = App\Model\InvoiceDetail::where('product_id',$details->product_id)->where('status','1')->sum('free_selling_qty');
                                        $stock_out_qty = App\Model\StockOutDetail::where('product_id',$details->product_id)->where('status','1')->sum('quantity');
                                        $total_out_qty = $selling_qty+$selling_free_qty+$stock_out_qty;
                                        $stock = $total_in_qty-$total_out_qty;

                                    @endphp
						            <tr>
						            	<input type="hidden" name="reason_id[]" value="{{$details->reason_id}}">
						            	<input type="hidden" name="category_id[]" value="{{$details->category_id}}">
						            	<input type="hidden" name="product_id[]" value="{{$details->product_id}}">
						            	<input type="hidden" name="quantity[{{$details->id}}]" value="{{$details->quantity}}">
						            	<td>{{$key+1}}</td>
						            	<td>{{@$details['reason']['name']}}</td>
						            	<td>{{@$details['category']['name']}}</td>
						            	<td>{{@$details['product']['name']}}</td>
						            	<td class="text-center" style="background: #1B9F5E;padding: 1px; color: #fff;">
						            		{{@$stock}}
						            	</td>
						            	<td>{{$details->quantity}}</td>
						            </tr>
						            @endforeach
						          </tbody>
						        </table>
								<button type="submit" class="btn btn-primary">Stock Out Approve</button>
							</div>
						</form>
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
