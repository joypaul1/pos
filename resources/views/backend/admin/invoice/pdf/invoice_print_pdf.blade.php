<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ optional($invoice->customer)->name . '-' . date('m-d-Y') ?? date('m-d-Y') }}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
</head>
<style>
    body {

        /* background: url("{{ asset('motor.png') }}") ; */
        background-repeat: no-repeat;
        background-position: 50% 50%;
        border: 0;
        margin-bottom: 20%;
        opacity: 0.9;
    }
    #invoice {
        padding: 30px;
    }

    .invoice {
        position: relative;
        /* background-color: #fff; */
        min-height: 680px;
        padding: 15px;
    }

    .invoice header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 3px double #3989c6;
    }

    .invoice .company-details {
        text-align: right;
    }

    .invoice .company-details .name {
        margin-top: 0;
        margin-bottom: 0;
    }

    .invoice .contacts {
        margin-bottom: 20px;
    }

    .invoice .invoice-to {
        text-align: left;
    }

    .invoice .invoice-to .to {
        margin-top: 0;
        margin-bottom: 0;
    }

    .invoice .invoice-details {
        text-align: right;
    }

    .invoice .invoice-details .invoice-id {
        margin-top: 0;
        color: #3989c6;
    }

    .invoice main {
        padding-bottom: 50px;
    }

    .invoice main .thanks {
        margin-top: -100px;
        font-size: 2em;
        margin-bottom: 50px;
    }

    .invoice main .notices {
        padding-left: 6px;
        border-left: 6px solid #3989c6;
    }

    .invoice main .notices .notice {
        font-size: 1.2em;
    }

    .invoice table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        /* margin-bottom: 20px; */
    }

     .invoice table td,
    .invoice table th {
        padding: 10px;
        border: 1px solid #3782bc;
    }

    .invoice table th {
        white-space: nowrap;
        font-size: 16px;
    }

    .invoice table td h3 {
        margin: 0;
        font-weight: 400;
        color: #3989c6;
        font-size: 1.2em;
    }

    .invoice table .qty,
    .invoice table .total,
    .invoice table .unit {
        text-align: right;
        font-size: 1.2em;
    }


    .invoice table tfoot td {
        background: 0 0;
        white-space: nowrap;
        text-align: right;
        font-size: 1.2em;

    }

    .invoice table tfoot tr:first-child td {
        border-top: none;
    }

    .invoice table tfoot tr:last-child td {
        /* color: #3989c6; */
        /* font-size: 1.4em; */
        /* border-top: 1px solid #3989c6; */
    }

    .invoice table tfoot tr td:first-child {

    }

    .invoice footer {
        width: 100%;
        text-align: center;
        color: #777;
        border-bottom: 1px solid #aaa;

    }

    .bg-voilet {
        background-color: #0e6a91;
    }

    .bd-dotted {
        border-bottom: 2px dotted gray !important;
    }

    .table-header {
        background: green;
        color: white;
    }

    @media print {
        @page {
            size: A4 landscape;
            margin: 0;

        }

        body {
            /* content:url("http://127.0.0.1:8000/motor.png"); */
            /* -webkit-print-color-adjust: exact !important; Chrome, Safari */
            /* color-adjust: exact !important;  Firefox */
            /* display: inline; */
            /* background: url("{{ asset('/public/motor.png') }}") ;
            background-repeat: no-repeat;
            background-position: 50% 50%;
            border: 0;
            margin-bottom: 20%;
            opacity: 0.9; */
            -webkit-print-color-adjust: exact !important;
            color-adjust: exact !important;
            /* background-image: url("{{ asset('motor.png') }}") ; */
            /* background-repeat: no-repeat; */
            background:url("{{ asset('motor.png') }}") no-repeat;
            /* background-position: 50% 50%; */
            /* border: 0;
            margin-bottom: 20%;
            opacity: 0.9; */
            /* background-image: linear-gradient(rgba(0, 0, 180, 0.5), rgba(70, 140, 220, 0.5)) !important; */
            /* background-size: contain;
            justify-content: center;
            print-color-adjust: exact; */
            /* z-index: 9999999999900; */

        }

        .invoice {
            font-size: 11px !important;
            overflow: hidden !important;
        }

        .bg-voilet {
            background-color: #0e6a91 !important;
            /* -webkit-print-color-adjust: exact !important;; */
        }

        .invoice footer {
            position: absolute;
        }

        .invoice>div:last-child {
            page-break-after: always;
        }

        .hidden-print {
            display: none !important;
        }
    }
</style>
<body >
    <div id="invoice">
        <div class="toolbar hidden-print">
            <div class="text-right">
                <button id="printInvoice" class="btn btn-info">
                    <i class="fa fa-print"></i> Print
                </button>
            </div>
            <hr />
        </div>
        <div class="invoice overflow-auto">


            <div style="min-width: 600px">
                <header>
                    <div class="row">
                        <div class="col-md-3">
                            <a target="_blank" href="https://lobianijs.com">
                                <img src="{{ !empty($owner->image) ? url('public/backend/user_images/' . $owner->image) : url('public/backend/images/noimage.png') }}"
                                    style="height: 120px;width: 150px;">
                                    {{-- <img src="https://placeimg.com/140/280/animals" alt=""   style="height: 120px;width: 150px;"/> --}}
                            </a>
                        </div>
                        <div class=" bike col-md-6 company-details text-center" id="">
                            <h4> Sale Invoice</h4>
                            <h2 class="name"><strong style="color: green">???????????? ???????????????</strong></h2>
                            <h2 class="name"><strong style="color: blue">{{ $owner->name }}</strong></h2>
                            <h3 class="name"><strong style="color: red">{{ $owner->address }}</strong></h3>
                            <h4 class="name">Mobile: <strong>{{ $owner->mobile }}</strong></h4>
                        </div>



                        <div class="col-md-3" style="border:2px solid #3989c6">
                            <p style="font-size: 18px;"> <strong>Buyer's</strong>
                                <br>
                                &nbsp; &nbsp;&nbsp;<b>{{ optional($invoice->customer)->name ?? ' ' }}</b> <br>
                                &nbsp;&nbsp; S/O {{ optional($invoice->customer)->father_name ?? ' ' }} <br>
                                &nbsp;&nbsp;&nbsp; Vill &nbsp;: {{ optional($invoice->customer)->village ?? ' ' }} <br>
                                &nbsp;&nbsp;&nbsp; Post: {{ optional($invoice->customer)->post_office ?? ' ' }} <br>
                                <!-- Up &nbsp;  :{{ optional($invoice->customer)->name ?? ' ' }} <br> -->
                                &nbsp;&nbsp;&nbsp; Dist &nbsp;: {{ optional($invoice->customer)->district ?? ' ' }}
                            </p>

                        </div>


                        {{-- <div class="bike"> fdfsdf</div> --}}




                    </div>
                </header>

                <main>


                    <div class="row contacts">
                        <div class="col-md-2s">
                            <div class="text-gray-light text-left">Invoice No : &nbsp;</div>
                        </div>
                        <div class="col-md-2" style="border-bottom: 2px dotted; width: 100%"> #
                            {{ $invoice->invoice_no ?? '' }} </div>

                        <div class="col-md-7">
                            <div class="text-gray-light text-right">Date: </div>
                        </div>
                        <div class="col-md-2" style="border-bottom: 2px dotted; width: 100%">
                            {{date('d-m-Y', strtotime($invoice->date)) }}</div>
                    </div>

                    <table width="100%">
                        <thead>

                            <tr>
                                <th class="text-center table-header" style="width: 5%">
                                    Sl No.
                                </th>
                                <th class="text-center table-header" style="width: 10%">
                                    Part Id.
                                </th>
                                <th class="text-center table-header" style="width: 10%">
                                    Part Name.
                                </th>

                                <th class="text-center table-header" style="width: 15%">
                                    Model Name.
                                </th>


                                <th class="text-center table-header">
                                    Qnty
                                </th>
                                <th class="text-center table-header" style="width: 30%">Description</th>
                                <th class="text-center table-header" style="width: 5%">Unit Price</th>
                                <th class="text-center table-header" style="width: 20%">
                                    Amount
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($invoice->invoice_details as $key=>$item)
                            {{-- @dd($item); --}}
                            <tr style="" aria-rowspan="">
                                <td class="no">{{ $key + 1 }}</td>
                                <td class="text-left">{{ optional($item->product)->name ?? '-' }}</td>
                                <td class="unit">{{ optional($item->product)->pname ?? '-' }}</td>
                                <td class="unit">{{ optional($item->product)->pmname ?? '-' }}</td>
                                <td class="total">{{ $item->selling_qty ?? '-' }}</td>
                                <td class="total">{{ optional($item->product)->size ?? '-' }}</td>

                                <td class="total">{{ $item->selling_price ?? '-' }}</td>
                                <td class="total">{{ $item->total_price ?? '-' }}</td>
                            </tr>
                            @empty

                            @endforelse

                        </tbody>
                        <tfoot>
                            <tr>
                                <td style="border-right: 0; border-bottom: 0">
                                    <!-- Take In Word : -->
                                    <span class="text-left">Take In Word :</span>
                                </td>
                                <td class="text-left" style="border-left: 0; border-bottom: 2px dotted gray"
                                    colspan="5"> {{ucwords( numberTowords($invoice->total_amount ?? '0')) }} Only. </td>

                                <td class="text-center" style="font-size: 16px; font-weight: 600">
                                    Total Amount
                                </td>
                                <td class="text-right">{{ $invoice->total_amount ?? '0' }}</td>
                            </tr>
                            <tr>
                                <td style="border-right: 0; border-top: 0;border-bottom:0" colspan="4"></td>
                                <td style="border-left: 0; border-top: 0;border-bottom:0" colspan="2"></td>
                                <td class="text-center" style="font-size: 16px; font-weight: 600">
                                    Discount Amount
                                </td>
                                <td class="text-right">{{ $invoice->discount_amount ?? '0' }}</td>

                            </tr>
                            <tr>
                                <td style="border-right: 0; border-top: 0;border-bottom:0" colspan="4"></td>
                                <td style="border-left: 0; border-top: 0;border-bottom:0" colspan="2"></td>
                                <td class="text-center" style="font-size: 16px; font-weight: 600">
                                    Service chnarge
                                </td>
                                <td class="text-right">{{ $invoice->service_charge ?? '0' }}</td>

                            </tr>

                            <tr>

                                <td style="border-top: 0;border-bottom:0" colspan="6"></td>
                                <td class="text-center" style="font-size: 16px; font-weight: 600">
                                    Grand Amount
                                </td>
                                <td class="text-right">{{ $invoice->grand_total ?? '0' }}</td>
                            </tr>
                            <tr>
                                <td style="border-right: 0; border-top: 0;border-bottom:0" colspan="6"></td>

                                <td class="text-center" style="font-size: 16px; font-weight: 600">
                                    Paid Amount
                                </td>
                                <td class="text-right">{{ $invoice->paid_amount ?? '0' }}</td>
                            </tr>
                            <tr>
                                <td style="border-right: 0; border-top: 0;border-bottom: 0" colspan="4"></td>
                                <td style="border-left: 0; border-top: 0 ; border-bottom: 0" colspan="2"></td>
                                <td class="text-center" style="font-size: 16px; font-weight: 600">
                                    Due Amount
                                </td>
                                <td class="text-right">{{ $invoice->due_amount ?? '0' }}</td>

                            </tr>


                            <tr>
                                <td colspan="6" class="text-left">Payment Reference :</td>
                                <td colspan="2" style="border-top:0 ;border-bottom: 0;"> </td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-left">M.R. No :</td>
                                <td colspan="3" class="text-left">Dated : {{ date('d-m-Y') }}</td>

                            </tr>
                            <tr>
                                <td colspan="6" class="text-left">For Taka :</td>
                                <td colspan="2" style="border-top:0 ;border-bottom: 0;">
                                </td>
                            </tr>

                            <tr>
                                <td class="text-left" colspan="1" style="border-right: 0">In Cash/ by :</td>
                                <td colspan="5" style="border-left: 0;" {{-- {{ $invoice->updatedUser->name??' ' }}
                                    --}}></td>
                                <td colspan="2" class="text-center" style="border-top:0;">
                                    <span style="border-top:2px dotted gray;">Sales Department</span>
                                </td>
                            </tr>

                        </tfoot>
                    </table>

                </main>

            </div>
            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
            <div></div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('jquery-3.3.1.slim.min.js') }}" ></script>
	<script src="{{ asset('popper.min.js') }}" ></script>
	<script src="{{ asset('bootstrap.min.js') }}" ></script>

    <script>
        $("#printInvoice").click(function() {
            Popup($(".invoice")[0].outerHTML);

            function Popup(data) {
                window.print();
                return true;
            }
        });
        $(document).ready(function() {
            // window.print();
        })
    </script>
</body>

</html>
