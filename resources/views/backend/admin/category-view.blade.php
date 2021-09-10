@extends('backend.layouts.master')
@section('content')
<div class="content-page">
    
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
						<h2 class="main-title float-left">Manage Category</h2>
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item">Home</li>
							<li class="breadcrumb-item">Category</li>
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
							<h5>Category List
								<a class="btn btn-sm btn-success float-right" href="{{route('categories.category.add')}}"><i class="fa fa-plus-circle"></i> Add Category</a>
							</h5>
						</div>
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped dt-responsive nowrap" style="width: 100%">
								<thead>
									<tr>
										<th>S/L </th>
										<th>Category Name</th>
										<th>Action </th>
									</tr>
								</thead>
								<tbody>
									@foreach ($allData as $key => $category)
									<tr class="{{$category->id}}">
										<td>{{$key+1}}</td>
										<td>{{$category->name}}</td>
										<td>
											<a class="btn btn-sm btn-info" title="Edit" href="{{route('categories.category.edit',$category->id)}}"><i class="fa fa-edit"></i></a>
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