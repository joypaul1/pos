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
							<h5>{{(@$editData) ? ("Update Product") : "Add Product"}}
								<a class="btn btn-sm btn-success float-right" href="{{route('products.product.view')}}"><i class="fa fa-list"></i> Product List</a>
							</h5>
						</div>
						<div class="card-body">
							<form method="post" action="{{!empty($editData->id) ? route('products.product.update',$editData->id) : route('products.product.store')}}" id="myForm" enctype="multipart/form-data">
				            	{{csrf_field()}}
				            	<div class="form-row">
				            		<div class="form-group col-md-4">
						                <label>Supplier Name</label>
						                <select name="supplier_id" id="supplier_id" class="form-control">
						                	<option value="">Select Supplier</option>
						                	@foreach($suppliers as $supplier)
						                	<option value="{{$supplier->id}}" {{(@$editData->supplier_id==$supplier->id)?"selected":""}}>{{$supplier->name}}</option>
						                	@endforeach
						                </select>
					              	</div>
				            		<div class="form-group col-md-4">
						                <label>Category Name</label>
						                <select name="category_id" id="category_id" class="form-control">
						                	<option value="">Select Category</option>
						                	@foreach($categories as $cat)
						                	<option value="{{$cat->id}}" {{(@$editData->category_id==$cat->id)?"selected":""}}>{{$cat->name}}</option>
						                	@endforeach
						                </select>
					              	</div>
					              	<div class="form-group col-md-4">
						                <label>Unit Name</label>
						                <select name="unit_id" class="form-control">
						                	<option value="">Select Unit</option>
						                	@foreach($units as $unit)
						                	<option value="{{$unit->id}}" {{(@$editData->unit_id==$unit->id)?"selected":""}}>{{$unit->name}}</option>
						                	@endforeach
						                </select>
					              	</div>
					            	<div class="form-group col-md-6">
						                <label>Product Name</label>
						                <input type="text" name="name" class="form-control" value="{{@$editData->name}}" placeholder="Write Name">
					              	</div>
					              	<div class="form-group col-md-3">
						                <label>Sheif No</label>
						                <input type="text" name="sheif_no" class="form-control" value="{{@$editData->sheif_no}}">
					              	</div>
					              	<div class="form-group col-md-3" style="padding-top: 30px;">
				                		<button type="submit" class="btn btn-primary">{{(@$editData) ? 'Update' : 'Submit'}}</button>
				              		</div>
					            </div>
				          	</form>
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
<script>
    $(document).ready(function(){
    	$('#myForm').validate({
    		errorClass:'text-danger',
	      	validClass:'text-success',
	        rules : {
	            supplier_id : {
	                required : true
	            },
	            category_id : {
	                required : true
	            },
	            unit_id : {
	                required : true
	            },
	            name : {
	                required : true
	            }
	        },
	        messages : {
	        	
	        }
	    });
    });
</script>

@endsection