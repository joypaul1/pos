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
						                	<option value="{{$supplier->id}}"
                                                {{(@$editData->supplier_id==$supplier->id)?"selected":""}}>{{$supplier->name}}</option>
						                	@endforeach
						                </select>
					              	</div>
				            		<div class="form-group col-md-4">
						                <label>Category Name</label>
						                <select name="category_id" id="category_id" class="form-control">
						                	<option value="">Select Category</option>
						                	@foreach($categories as $cat)
						                	<option value="{{$cat->id}}" {{(@ $editData->category_id==$cat->id)?"selected":""}}>{{$cat->name}}</option>
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
					              	<div class="form-group col-md-6">
						                <label>Sheif No</label>
						                <input type="text" name="sheif_no" class="form-control" value="{{@$editData->sheif_no}}">
					              	</div>
                                    <div class="form-group col-md-6">
						                <label>Model Of vehicle</label>
						                <input type="text" name="model_Of_vehicle" class="form-control"
                                         value="{{ @$editData->model_Of_vehicle }}" placeholder="Write model_Of_vehicle">
					              	</div>
                                    <div class="form-group col-md-6">
						                <label>Class Of vehicle</label>
						                <input type="text" name="class_Of_vehicle" class="form-control"
                                         value="{{ @$editData->class_Of_vehicle }}" placeholder="Write class_Of_vehicle">
					              	</div>
                                    <div class="form-group col-md-6">
						                <label>chasiss no</label>
						                <input type="text" name="chasiss_no" class="form-control"
                                         value="{{ @$editData->chasiss_no }}" placeholder="Write chasiss_no">
					              	</div>

                                    <div class="form-group col-md-6">
						                <label>Engine No</label>
						                <input type="text" name="engine_no" class="form-control"
                                         value="{{ @$editData->engine_no }}" placeholder="Write engine_no">
					              	</div>
                                    <div class="form-group col-md-6">
						                <label>Key No</label>
						                <input type="text" name="key_no" class="form-control"
                                         value="{{ @$editData->key_no }}" placeholder="Write key_no">
					              	</div>
                                    <div class="form-group col-md-6">
						                <label>None of Cylineder with CC</label>
						                <input type="text" name="none_of_cylineder_with_cc" class="form-control"
                                         value="{{ @$editData->none_of_cylineder_with_cc }}"
                                          placeholder="Write none_of_cylineder_with_cc">
					              	</div>
                                    <div class="form-group col-md-6">
						                <label>Colour</label>
						                <input type="text" name="colour" class="form-control"
                                         value="{{ @$editData->colour }}" placeholder="Write colour">
					              	</div>
                                    <div class="form-group col-md-6">
						                <label>Size</label>
						                <input type="text" name="size" class="form-control"
                                         value="{{ @$editData->size }}" placeholder="Write size">
					              	</div>
                                    <div class="form-group col-md-6">
						                <label>Year Of Manufacture/Assembel</label>
						                <input type="text" name="year_of_manufacture" class="form-control"
                                         value="{{ @($editData->year_of_manufacture) }}" placeholder="Write year_of_manufacture">
					              	</div>
                                    <div class="form-group col-md-6">
						                <label>Hourse Power</label>
						                <input type="text" name="hourse_power" class="form-control"
                                         value="{{ @($editData->hourse_power) }}" placeholder="Write hourse_power">
					              	</div>
                                    <div class="form-group col-md-6">
						                <label>Laden Weight</label>
						                <input type="text" name="laden_weight" class="form-control"
                                         value="{{ @($editData->laden_weight) }}" placeholder="Write laden_weight">
					              	</div>
                                    <div class="form-group col-md-6">
						                <label>Wheel Base</label>
						                <input type="text" name="wheel_base" class="form-control"
                                         value="{{ @($editData->wheel_base) }}" placeholder="Write wheel_base">
					              	</div>
                                    <div class="form-group col-md-6">
						                <label>Seating Capacity</label>
						                <input type="text" name="seating_capacity" class="form-control"
                                         value="{{ @($editData->seating_capacity) }}" placeholder="Write seating_capacity">
					              	</div>
                                    <div class="form-group col-md-6">
						                <label>Makers Name</label>
						                <input type="text" name="makers_Name" class="form-control"
                                         value="{{ @($editData->makers_Name) }}" placeholder="Write seating_capacity">
					              	</div>
                                    <div class="form-group col-md-6">
						                <label>Unit Price</label>
						                <input type="text" name="unit_price" class="form-control"
                                         value="{{ @($editData->unit_price) }}" placeholder="Write unit_price">
					              	</div>
                                    <br>
					              	<div class="form-group col-md-6" style="padding-top: 30px;">
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
