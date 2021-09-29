<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title> Sebanto </title>
		<!-- <meta name="description" content="Free Bootstrap 4 Admin Theme | Pike Admin"> -->
		<meta name="author" content="Pike Web Development - https://www.pikephp.com">

		<!-- Favicon -->
		<link rel="shortcut icon" href="{{asset('fontend/favicon.ico')}}" type="image/x-icon" >

		<!-- Bootstrap CSS -->
		<link href="{{asset('backend')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

		<!-- Font Awesome CSS -->
		<link href="{{asset('backend')}}/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

		<!-- Custom CSS -->
		<link href="{{asset('backend')}}/css/style.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('backend')}}/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

		<style type="text/css">
            .warning{
                border-color: red
            }
            .hidden{
                display: none !important;
            }
			.headerpart{
		        color:#28aade;
		        padding: 0px 0px 30px 0px;
		    }
		    .fullbody{
		        padding: 10px 0px 30px 0px;
		    }
			/*notify js*/
    		.notifyjs-corner{
    			z-index:10000 !important;
    		}

			/*badge notification*/
		    .badge1 {
		        position:relative;
		    }
		    .badge1[data-badge]:after {
		       content:attr(data-badge);
		       position:absolute;
		       top:-10px;
		       right:-10px;
		       font-size:.7em;
		       background:red;
		       color:white;
		       width:18px;height:18px;
		       text-align:center;
		       line-height:18px;
		       border-radius:50%;
		       box-shadow:0 0 1px #333;
		    }
		</style>
		<script src="{{asset('backend')}}/js/jquery.min.js"></script>
		<!-- sweet-alert -->
		<script src="{{asset('backend')}}/sweetalert/sweetalert.js"></script>
		<link href="{{asset('backend')}}/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('backend/plugins/datetimepicker/css/daterangepicker.css')}}" rel="stylesheet" />
        <!-- select2 -->
        <link rel="stylesheet" href="{{asset('backend/select2/select2.min.css')}}">
        <!-- BEGIN CSS for this page -->
        <link href="{{asset('backend')}}/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
        <link href="{{asset('backend')}}/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />
        <script src="{{asset('backend/js/handlebars-v4.0.12.js')}}"></script>
        <!--Year and month Picker-->
        <link href="{{asset('public')}}/dist/css/datepicker.min.css" rel="stylesheet" type="text/css">
        <script src="{{asset('public')}}/dist/js/datepicker.min.js"></script>
        <script src="{{asset('public')}}/dist/js/i18n/datepicker.en.js"></script>


        @stack('css')
</head>

<body class="adminbody">

<div id="main">

	<!-- top bar navigation -->
	<div class="headerbar">

		<!-- LOGO -->
        <div class="headerbar-left">
			<a href="{{route('admin.home')}}" class="logo"><img alt="" src="">
                <span>{{Auth::user()->name}}</span></a>
        </div>

        <nav class="navbar-custom">

                    <ul class="list-inline float-right mb-0">

                        <li class="list-inline-item dropdown notif">
                            <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="{{(!empty(Auth::user()->image)) ? url('backend/user_images/'.Auth::user()->image):asset('backend/images/avatars/admin.png')}}" alt="Profile image" class="avatar-rounded">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="text-overflow"><small> {{Auth::user()->name }}</small> </h5>
                                </div>

                                <!-- item-->
                                <a href="{{route('profile.user.view')}}" class="dropdown-item notify-item">
                                    <i class="fa fa-user"></i> <span>Profile</span>
                                </a>

                                <!-- item-->
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
                                    <i class="fa fa-power-off"></i> <span>Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                </form>
                            </div>
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left">
								<i class="fa fa-fw fa-bars"></i>
                            </button>
                        </li>
                    </ul>

        </nav>

	</div>
	<!-- End Navigation -->

	<!-- left sidebar-->
	@include('backend.layouts.navbar')
	<!--left sidebar -->

    @yield('content')
    <!-- Start content-page -->
    <div class="content-page">
        @include('backend.layouts.notification')
    </div>
    <!-- END content-page -->

	<footer class="footer">
		<span class="text-right">
		Copyright <a href="#">&copy; Supto </a>
		</span>
		<span class="float-right">
		Designed and Developed by <a target="_blank" href="https://amiritsoft.com/"><b>Amir IT Soft</b></a>
		</span>
	</footer>
    <!-- Current date time -->
    @php
        $date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $current_date = $date->format('F j, Y, g:i a');
    @endphp
</div>
<!-- END main -->
<script src="{{asset('backend')}}/js/modernizr.min.js"></script>
<script src="{{asset('backend')}}/js/moment.min.js"></script>

<script src="{{asset('backend')}}/js/popper.min.js"></script>
<script src="{{asset('backend')}}/js/bootstrap.min.js"></script>
<!--Validate-->
<script src="{{asset('backend')}}/validate/jquery.validate.min.js"></script>
<!--Notify JS-->
<script src="{{asset('backend')}}/notify/notify.js"></script>
<script src="{{asset('backend')}}/js/detect.js"></script>
<script src="{{asset('backend')}}/js/fastclick.js"></script>
<script src="{{asset('backend')}}/js/jquery.blockUI.js"></script>
<script src="{{asset('backend')}}/js/jquery.nicescroll.js"></script>

<!-- App js -->
<script src="{{asset('backend')}}/js/pikeadmin.js"></script>

<!-- BEGIN Java Script for this page -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="{{asset('backend')}}/datatable/jquery.dataTables.min.js"></script>
<script src="{{asset('backend')}}/datatable/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('backend/plugins/datetimepicker/js/moment.min.js')}}"></script>
<script src="{{asset('backend/plugins/datetimepicker/js/daterangepicker.js')}}"></script>
<!-- select2 -->
<script type="text/javascript" src="{{ asset('backend/select2/select2.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('backend/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/ckfinder/ckfinder.js') }}"></script>

<!-- Counter-Up-->
<script src="{{asset('backend')}}/plugins/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="{{asset('backend')}}/plugins/counterup/jquery.counterup.min.js"></script>
<script src="{{asset('backend')}}/plugins/jquery.filer/js/jquery.filer.min.js"></script>
@stack('js')
<script>
    $(document).ready(function () {
        $(document).on('click', '.delete', function () {
            var actionTo = $(this).attr('href');
            var token = $(this).attr('data-token');
            var id = $(this).attr('data-id');
            swal({
                    title: "Are you sure?",
                //  text: "You will not be able to recover this imaginary file!",
                    type: "success",
                    showCancelButton: true,
                    confirmButtonClass: 'btn-success',
                    confirmButtonText: 'Yes',
                    cancelButtonText: "No",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url:actionTo,
                            type: 'post',
                            data: {id:id, _token:token},
                            success: function (data) {
                                swal({
                                        title: "Deleted!",
                                    //   text: "Data has been Deleted.",
                                        type: "success"

                                    },

                                    function (isConfirm) {
                                        if (isConfirm) {
                                            location.reload();
                                        }
                                    });
                            }
                        });
                    } else {
                        swal("Cancelled", "", "error");
                    }
                });
            return false;
        });
    });
</script>

    <script>
        $(document).ready(function () {
            $(document).on('click', '.approveBtn', function () {
                var actionTo = $(this).attr('href');
                var token = $(this).attr('data-token');
                var id = $(this).attr('data-id');
                swal({
                        title: "Are you sure?",
                    //  text: "You will not be able to recover this imaginary file!",
                        type: "success",
                        showCancelButton: true,
                        confirmButtonClass: 'btn-success',
                        confirmButtonText: 'Yes',
                        cancelButtonText: "No",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url:actionTo,
                                type: 'post',
                                data: {id:id, _token:token},
                                success: function (data) {
                                    swal({
                                            title: "Approved!",
                                        //   text: "Data has been Deleted.",
                                            type: "success"

                                        },

                                        function (isConfirm) {
                                            if (isConfirm) {
                                                location.reload();
                                            }
                                        });
                                }
                            });
                        } else {
                            swal("Cancelled", "", "error");
                        }
                    });
                return false;
            });
        });
    </script>

    <!-- Start Java Script for Date time Picker -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.singledatepicker').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                autoUpdateInput: false,
                // drops: "up",
                autoApply:true,
                locale: {
                    format: 'YYYY-MM-DD',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                    firstDay: 0
                },
                minDate: '01/01/1930',
            },
            function(start) {
                this.element.val(start.format('YYYY-MM-DD'));
                this.element.parent().parent().removeClass('has-error');
            },
            function(chosen_date) {
                this.element.val(chosen_date.format('YYYY-MM-DD'));
            });

            $('.singledatepicker').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD'));
            });
        });

    </script>
    <!-- End Java Script for Data time Picker -->

	<script>
		$(document).ready(function() {
			// data-tables
			$('#example1').DataTable();

			// counter-up
			$('.counter').counterUp({
				delay: 10,
				time: 600
			});
		} );
	</script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

	{{-- <script>
    	var ctx1 = document.getElementById("lineChart").getContext('2d');
    	var lineChart = new Chart(ctx1, {
    		type: 'bar',
    		data: {
    			labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    			datasets: [{
    					label: 'Dataset 1',
    					backgroundColor: '#3EB9DC',
    					data: [10, 14, 6, 7, 13, 9, 13, 16, 11, 8, 12, 9]
    				}, {
    					label: 'Dataset 2',
    					backgroundColor: '#EBEFF3',
    					data: [12, 14, 6, 7, 13, 6, 13, 16, 10, 8, 11, 12]
    				}]

    		},
    		options: {
    						tooltips: {
    							mode: 'index',
    							intersect: false
    						},
    						responsive: true,
    						scales: {
    							xAxes: [{
    								stacked: true,
    							}],
    							yAxes: [{
    								stacked: true
    							}]
    						}
    					}
    	});


    	var ctx2 = document.getElementById("pieChart").getContext('2d');
    	var pieChart = new Chart(ctx2, {
    		type: 'pie',
    		data: {
    				datasets: [{
    					data: [12, 19, 3, 5, 2, 3],
    					backgroundColor: [
    						'rgba(255,99,132,1)',
    						'rgba(54, 162, 235, 1)',
    						'rgba(255, 206, 86, 1)',
    						'rgba(75, 192, 192, 1)',
    						'rgba(153, 102, 255, 1)',
    						'rgba(255, 159, 64, 1)'
    					],
    					label: 'Dataset 1'
    				}],
    				labels: [
    					"Red",
    					"Orange",
    					"Yellow",
    					"Green",
    					"Blue"
    				]
    			},
    			options: {
    				responsive: true
    			}

    	});


    	var ctx3 = document.getElementById("doughnutChart").getContext('2d');
    	var doughnutChart = new Chart(ctx3, {
    		type: 'doughnut',
    		data: {
    				datasets: [{
    					data: [12, 19, 3, 5, 2, 3],
    					backgroundColor: [
    						'rgba(255,99,132,1)',
    						'rgba(54, 162, 235, 1)',
    						'rgba(255, 206, 86, 1)',
    						'rgba(75, 192, 192, 1)',
    						'rgba(153, 102, 255, 1)',
    						'rgba(255, 159, 64, 1)'
    					],
    					label: 'Dataset 1'
    				}],
    				labels: [
    					"Red",
    					"Orange",
    					"Yellow",
    					"Green",
    					"Blue"
    				]
    			},
    			options: {
    				responsive: true
    			}

    	});
	</script> --}}

	<!-- END Java Script for this page -->
    <script>
        $(document).ready(function(){
            'use-strict';
            //Example 2
            $('#filer_example2').filer({
                limit: 3,
                maxSize: 3,
                extensions: ['jpg', 'jpeg', 'png', 'gif', 'psd'],
                changeInput: true,
                showThumbs: true,
                addMore: true
            });
        });
    </script>

</body>
</html>
