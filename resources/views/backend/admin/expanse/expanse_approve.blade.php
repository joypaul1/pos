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
							<h5>Expense Approve
								<a class="btn btn-sm btn-success float-right" href="{{route('expanses.expanse.view')}}"><i class="fa fa-list"></i> Expense List</a>
							</h5>
						</div>
						<div class="card-body">
							<form method="post" action="{{route('expanses.expanse.approve')}}" id="myForm" enctype="multipart/form-data">
				            	{{csrf_field()}}
				            	<table class="table table-sm table-bordered">
						          <thead>
						            <tr>
						              <th>Date</th>
						              <th>Expense Type</th>
						              <th>Amount</th>
						            </tr>
						          </thead>
						          <tbody>
						              <tr>
						                <td>{{date('d-m-Y',strtotime($editData->date))}}</td>
						                <td>{{@$editData['expanse_type']['name']}}</td>
						                <td>{{$editData->amount}} TK</td>
						              </tr>
						          </tbody>
						        </table>
					            <div class="form-row">
					            	<input type="hidden" name="id" value="{{$editData->id}}">
					              	<div class="form-group col-md-3">
						                <label>Approve Date</label>
						                <input type="text" name="date" value="{{@$cdate}}" class="form-control form-control-sm singledatepicker" placeholder="YYYY-MM-DD" required="" readonly>
					              	</div>
					              	<div class="form-group col-md-2" style="padding-top: 30px;">
				                		<button type="submit" class="btn btn-primary btn-sm">Approve</button>
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

<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','.expanse_type_id',function(){
            var expanse_type_id = $(this).val();
            if(expanse_type_id == '0'){
                $('.others_expanse_type').show();
            }else{
                $('.others_expanse_type').hide();
            }
        });
    });
</script>
<script>
    $(document).ready(function(){
    	$('#myForm').validate({
    		ignore:[],
            errorPlacement: function(error, element){
                if (element.attr("name") == "project_id" ){ error.insertAfter(element.next()); }
                else if (element.attr("name") == "expanse_type_id" ){error.insertAfter(element.next()); }
                else{error.insertAfter(element);}
            },
    		errorClass:'text-danger',
	      	validClass:'text-success',
	        rules : {
	            project_id : {
	                required : true
	            },
	            expanse_type_id : {
	                required : true
	            },
	            amount : {
	                required : true
	            },
	            date : {
	                required : true
	            },
	        },
	        messages : {
	        	
	        }
	    });
    });
</script>

@endsection