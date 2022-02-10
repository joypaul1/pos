@extends('backend.layouts.master')
@section('content')
<div class="content-page">

    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
						<h2 class="main-title float-left">Manage Product</h2>
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item">Home</li>
							<li class="breadcrumb-item">Product</li>
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
							<h5>Product List
                                <a class="btn btn-sm btn-success float-right" href="{{route('products.product.add')}}"><i class="fa fa-plus-circle"></i> Add Product</a>
								<a class="btn btn-sm btn-info float-right" href="{{route('export')}}"><i class="fa fa-plus-circle"></i> Export Product</a>
								<a class="btn btn-sm btn-warning float-right" href="{{route('importExportView')}}"><i class="fa fa-plus-circle"></i> Import Product</a>
							</h5>
						</div>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped dt-responsive table-responsive" style="width: 100%">
								<thead>
									<tr>
										<th width="5%">S/L </th>
										<th>Supplier Name</th>
										<th>Category</th>
										<th>Unit Name</th>
										<th>Product Name</th>
										<th>Sheif No</th>
										<th width="10%">Action </th>
									</tr>
								</thead>
								<tbody>
									@foreach ($allData as $key => $product)
									<tr class="{{$product->id}}">
										<td>{{$key+1}}</td>
										<td>{{@$product['supplier']['name']}}</td>
										<td>{{@$product['category']['name']}}</td>
										<td>{{$product['unit']['name']}}</td>
										<td>{{$product->name}}</td>
										<td>{{$product->sheif_no}}</td>
										<td>
											<a class="btn btn-sm btn-info" title="Edit"
                                            href="{{route('products.product.edit',$product->id)}}">
                                            <i class="fa fa-edit"></i></a>
                                            <a target="_blank" class="btn btn-sm btn-success" title="Print" href="{{route('products.product.pdf',$product->id)}}"><i class="fa fa-print"></i></a>
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
