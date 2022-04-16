<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link
			href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
			rel="stylesheet"
		/>

		<style>
			* {
				-webkit-print-color-adjust: exact !important; /* Chrome, Safari, Edge */
				color-adjust: exact !important; /*Firefox*/
				box-sizing: border-box !important;
				border-color: #478fcc !important;
			}
			body {
				margin-top: 20px;
				color: #484b51;
			}
			.overlap {
				position: absolute;
				top: 0;
				height: 100%;
				width: 100%;
				opacity: 0.3;
				z-index: -1;
                background-size:40% auto;
                background-repeat:no-repeat;
                background-position:center center;
			}
			.text-secondary-d1 {
				color: #728299 !important;
			}
			.page-header {
				margin: 0 0 1rem;
				padding-bottom: 1rem;
				padding-top: 0.5rem;
				border-bottom: 1px dotted #e2e2e2;
				display: -ms-flexbox;
				display: flex;
				-ms-flex-pack: justify;
				justify-content: flex-end;
				-ms-flex-align: center;
				align-items: center;
			}
			.page-title {
				padding: 0;
				margin: 0;
				font-size: 1.75rem;
				font-weight: 300;
			}
			.brc-default-l1 {
				border-color: #dce9f0 !important;
			}

			.ml-n1,
			.mx-n1 {
				margin-left: -0.25rem !important;
			}
			.mr-n1,
			.mx-n1 {
				margin-right: -0.25rem !important;
			}
			.mb-4,
			.my-4 {
				margin-bottom: 1.5rem !important;
			}

			hr {
				margin-top: 1rem;
				margin-bottom: 1rem;
				border: 0;
				border-top: 1px solid rgba(0, 0, 0, 0.1);
			}
			.text-95 .border {
				border-color: #3989c6 !important;
			}
			.text-grey-m2 {
				color: #888a8d !important;
			}

			.text-success-m2 {
				color: #86bd68 !important;
			}

			.font-bolder,
			.text-600 {
				font-weight: 600 !important;
			}

			.text-110 {
				font-size: 110% !important;
			}
			.text-blue {
				color: #478fcc !important;
			}
			.pb-25,
			.py-25 {
				padding-bottom: 0.75rem !important;
			}

			.pt-25,
			.py-25 {
				padding-top: 0.75rem !important;
			}
			.bgc-default-tp1 {
				background-color: green !important;
			}
			.bgc-default-l4,
			.bgc-h-default-l4:hover {
				background-color: #f3f8fa !important;
			}
			.page-header .page-tools {
				-ms-flex-item-align: end;
				align-self: flex-end;
				z-index: 999;
			}

			.btn-light {
				color: #757984;
				background-color: #f5f6f9;
				border-color: #dddfe4;
			}
			.w-2 {
				width: 1rem;
			}

			.text-120 {
				font-size: 120% !important;
			}
			.text-primary-m1 {
				color: #4087d4 !important;
			}

			.text-danger-m1 {
				color: #dd4949 !important;
			}
			.text-blue-m2 {
				color: #68a3d5 !important;
			}
			.text-150 {
				font-size: 150% !important;
			}
			.text-60 {
				font-size: 60% !important;
			}
			.text-grey-m1 {
				color: #7b7d81 !important;
			}
			.align-bottom {
				vertical-align: bottom !important;
			}

			@media print {
				@page {
					size: A4 landscape;
                    margin: 0 !important;
					transform: scale(0.90)  !important;
				}
				body{
					transform: scale(0.90) !important;
                    height: 100vh;
                    overflow: hidden;

				}
				.page-header {
					display: none;
				}
				.page-content {
					padding: 0;
					margin: 0;
				}
				* {
					margin: 0;
					padding: 0;
				}
				/* .break {
					page-break-after: always !important;
					page-break-inside: avoid !important;
					page-break-before: always !important;
				} */
			}
		</style>

		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
			crossorigin="anonymous"
		/>

		<title>{{$owner->name}}</title>
	</head>
	<body>
		<div class="page-content">
			<div class="page-header text-blue-d2">
				<div class="page-tools">
					<div class="action-buttons">
						<a
							class="btn bg-white btn-light mx-1px text-95"
							href="#"
							data-title="Print"
							id="printInvoice"
						>
							<i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
							Print
						</a>
					</div>
				</div>
			</div>

			<div class="px-0 invoice">
				<div class="row px-0 m-0">
					<div class="col-12 col-lg-12">
						<div class="row">
							<div class="col-3">
								{{-- <img src="./logo.png" width="100px" alt="" /> --}}
                                <img src="{{(!empty($owner->image)) ? url('public/backend/user_images/'.$owner->image) : url('public/backend/images/noimage.png')}}"
                                style="height: 120px;width: 150px;">
							</div>
							<!-- /.col -->
							<div class="col-6 text-center">
								<p class="p-0 m-0">Sale Invoice</p>
								<h4 class="p-0 m-0" style="color: green">নোভা বাজাজ</h4>
								<h4 class="p-0 m-0" style="color: blue">{{$owner->name}}</</h4>
								<h6 class="p-0 m-0" style="color: green">
									Authorised Dealer: Uttara Motors Limited
								</h6>
								<h5 class="p-0 m-0" style="color: red">{{$owner->address}}</h5>
								<p class="p-0 m-0">
									Mobile: <strong>{{$owner->mobile}}</strong>,
									<strong>{{$owner->email}}</strong>
								</p>
							</div>
							<div
								class="text-95 col-3 align-self-start d-sm-flex justify-content-end"
							>
								<hr class="d-sm-none" />
								<div class="text-grey-m2 p-2" style="border: 1px solid #3989c6">
									<div class="my-1">
										<i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
										<span class="text-600 text-90">Buyer's :</span> {{ optional($invoice->customer)->name??' ' }}
									</div>

									<div class="my-1">
										<i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
										<span class="text-600 text-90">S/O:</span> {{ optional($invoice->customer)->father_name??' ' }}
									</div>

									<div class="my-1">
										<i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
										<span class="text-600 text-90">Vill :</span>
                                        {{ optional($invoice->customer)->village??' ' }}
									</div>
									<div class="my-1">
										<i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
										<span class="text-600 text-90">Post :</span>
										{{ optional($invoice->customer)->post_office??' ' }}
									</div>
									<div class="my-1">
										<i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
										<span class="text-600 text-90">UP :</span>
                                        {{ optional($invoice->customer)->up??' ' }}
									</div>
									<div class="my-1">
										<i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
										<span class="text-600 text-90">Dist :</span>
                                        {{ optional($invoice->customer)->district??' ' }}
									</div>
								</div>
							</div>
							<!-- /.col -->
						</div>
						<hr style="background-color: #3989c6; height: 2px; opacity: 1" />


						<div class="row">
							<div class="col-4">
								<div class="d-flex">
									<p class="pe-2">L/C No:</p>
									<p
										style="
											border-bottom: 2px dotted #333;
											min-width: 50%;
											padding: 1px;
										"
									></p>
								</div>
							</div>
							<div class="col-4">
								<div class="d-flex">
									<p class="pe-2">Vessel Name:</p>
									<p
										style="
											border-bottom: 2px dotted #333;
											min-width: 50%;
											padding: 1px;
										"
									></p>
								</div>
							</div>
							<div class="col-4">
								<div class="d-flex">
									<p class="pe-2">Sales Invoice :</p>
									<p
										style="
											border-bottom: 2px dotted #333;
											min-width: 50%;
											padding: 1px;
										"
									>
										#
									</p>
								</div>
							</div>
							<div class="col-4">
								<div class="d-flex">
									<p class="pe-2">Invoice No:</p>
									<p
										style="
											border-bottom: 2px dotted #333;
											min-width: 50%;
											padding: 1px;
										"
									>
                                    #{{ $invoice->invoice_no??'' }}
									</p>
								</div>
							</div>
							<div class="col-4">
								<div class="d-flex">
									<p class="pe-2">B/E No :</p>
									<p
										style="
											border-bottom: 2px dotted #333;
											min-width: 50%;
											padding: 1px;
										"
									>
										#
									</p>
								</div>
							</div>
							<div class="col-4">
								<div class="d-flex">
									<p class="pe-2">Date :</p>
									<p
										style="
											border-bottom: 2px dotted #333;
											min-width: 50%;
											padding: 1px;
										"
									>
                                    {{date('d-m-Y', strtotime($invoice->date)) }}
                                </p>
								</div>
							</div>
						</div>

                        <div style="position: relative" >
                            <table class="table table-bordered">
                                <thead style="background-color: green; color: #fff">
                                    <tr>
                                        <th style="text-align:center;width:2%" scope="col">No.</th>
                                        <th style="text-align:center;width:12%" scope="col">Chassis No.</th>
                                        <th style="text-align:center;width:12%" scope="col">Engine No.</th>
                                        <th style="text-align:center;width:7%" scope="col">Key No.</th>
                                        <th style="text-align:center;width:10%" scope="col">Color</th>
                                        <th style="text-align:center;width:2%" scope="col">Qty</th>
                                        <th style="text-align:center;width:26%" scope="col">Description</th>
                                        <th style="text-align:center;width:10%" scope="col">Unit Price</th>
                                        <th style="text-align:center;width:10%" scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($invoice->invoice_details as $key=>$item)
                                    <tr>
                                        <td style="text-align:center" >{{ $key+1 }}</td>
                                        <td style="text-align:center">{{ $item->chasiss_no??'-' }}</td>
                                        <td style="text-align:center">{{ $item->engine_no?? '-'}}</td>
                                        <td style="text-align:center">{{ optional($item->product)->key_no??'-' }}</td>
                                        <td style="text-align:center">{{ $item->color??'-' }}</td>
                                        <td style="text-align:center">{{ $item->selling_qty ??'-' }}</td>
                                        <td style="text-align:center"> {{ optional($item->product)->description??'-' }}</td>
                                        <td style="text-align:right">{{ $item->selling_price??'-' }}</td>
                                        <td style="text-align:right">{{ $item->total_price??'-' }}</td>
                                    </tr>
                                    @empty

                                @endforelse
                                    <tr>
                                        <td class="col" colspan="7" rowspan="6">
                                            <div class="d-flex p-2">
                                                <h5 class="pe-2">Take In Word :</h5>
                                                <h6
                                                    style="
                                                        border-bottom: 2px dotted #333;
                                                        min-width: 80%;
                                                        padding: 1px;
                                                    "
                                                >
                                                {{ ucwords(numberTowords($invoice->total_amount??'0' )) }} Only.
                                                </h6>
                                            </div>
                                        </td>
                                        <td class="col">Total Amount</td>
                                        <td class="col">
                                            <h5 class="fw-bold text-right" style="text-align: right">{{ ($invoice->total_amount??'0' ) }}</h5>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="col"> Service charge</td>
                                        <td class="col" style="text-align: right"> {{ ($invoice->service_charge??'0' ) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col"> Grand Amount</td>
                                        <td class="col" style="text-align: right"> {{ ($invoice->grand_total??'0' ) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col">Paid Amount</td>
                                        <td class="col" style="text-align: right"> {{ ($invoice->paid_amount??'0' ) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col">Less Advance</td>
                                        <td class="col" style="text-align: right"> {{ ($invoice->paid_amount??'0' ) }}</td>
                                    </tr>

                                    <tr>
                                        <td class="col"> Due Amount</td>
                                        <td class="col" style="text-align: right">{{ $invoice->due_amount ?? '0' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="col" colspan="7">
                                            <strong> Payment Reference : </strong>
                                        </td>
                                        <td class="col" rowspan="4" colspan="2">
                                            <div
                                                class="text-center d-flex flex-column align-items-center justify-content-end h-100"
                                            >
                                                <strong>For Nova Bajaj</strong>

                                                <p style="border-top: 2px dotted green" class="mt-4">
                                                    Sales Department
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col" colspan="4">
                                            <strong> M.R. No : </strong>
                                        </td>
                                        <td class="col" colspan="3">
                                            <strong> Dated : {{ date('d-m-Y') }}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col" colspan="7">
                                            <strong> For Taka : </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col" colspan="7">
                                            <strong> In Cash/ by : </strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>



                        <div class="overlap" style="background-image:url('{{ asset('motor.png')}}');">

                        </div>
                        </div>

					</div>
				</div>
			</div>
		</div>

		<script
			src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
			integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
			crossorigin="anonymous"
		></script>
		<script
			src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
			integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
			crossorigin="anonymous"
		></script>
		<script
			src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
			integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
			crossorigin="anonymous"
		></script>

		<script>
			$('#printInvoice').click(function () {
				Popup($('.invoice')[0].outerHTML);
				function Popup(data) {
					window.print();
					return true;
				}
			});
			$(document).ready(function () {
				// window.print();
			});
		</script>
	</body>
</html>
