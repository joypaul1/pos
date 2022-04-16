<!DOCTYPE html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
</head>
<style>
    #invoice {
        padding: 25px;
    }

    .invoice {
        position: relative;
        background-color: #fff;
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
        margin-bottom: 20px;
    }

    .invoice table td,
    .invoice table th {
        /* padding: 15px; */
        /* background: #eee; */
        border: 1px solid gray;
    }

    .invoice table th {
        white-space: nowrap;
        font-weight: 400;
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

    .invoice table .no {
        color: #fff;
        font-size: 1.6em;
        background: #3989c6;
    }

    .invoice table .unit {
        background: #ddd;
    }

    .invoice table .total {
        background: #3989c6;
        color: #fff;
    }

    /* .invoice table tbody tr:last-child td {
        /* border: none; */
    } */

    .invoice table tfoot td {
        background: 0 0;
        border-bottom: none;
        white-space: nowrap;
        text-align: right;
        padding: 10px 20px;
        font-size: 1.2em;
        border-top: 1px solid #aaa;
    }

    .invoice table tfoot tr:first-child td {
        border-top: none;
    }

    .invoice table tfoot tr:last-child td {
        color: #3989c6;
        font-size: 1.4em;
        border-top: 1px solid #3989c6;
    }

    .invoice table tfoot tr td:first-child {
        border: none;
    }

    .invoice footer {
        width: 100%;
        text-align: center;
        color: #777;
        border-bottom: 1px solid #aaa;
        padding: 8px 0;
    }

    .bg-desing {
        border: 0 !important;
        font-weight: 600;
    }

    .bd-dotted {
        border-bottom: 2px dotted gray !important;
    }

    @media print {
        body {
            -webkit-print-color-adjust: exact;
        }

        .hidden-print {
            display: none !important;
        }
        /* .pagebreak{
            page-break-after: always;
        } */
    }
</style>

<body>
    <div id="invoice">
        <div class="toolbar hidden-print">
            <div class="text-right">
                <button id="printInvoice" class="btn btn-info">
                    <i class="fa fa-print"></i> Print
                </button>
                <button class="btn btn-info">
                    <i class="fa fa-file-pdf-o"></i> Export as PDF
                </button>
            </div>
            <hr />
        </div>
        <div class="invoice overflow-auto">
            <div style="min-width: 600px">
                <header>
                    <div class="row">
                        <div class="col-3">
                            <a target="_blank" href="https://lobianijs.com">
                                <img src="{{(!empty($owner->image)) ? url('public/backend/user_images/'.$owner->image) : url('public/backend/images/noimage.png')}}"
                                    style="height: 120px;width: 150px;">
                            </a>
                        </div>
                        <div class="col-6 company-details text-center">
                            <h3 class="name"><strong style="color: green; font-size: 40px; ">নোভা বাজাজ</strong></h3>
                            <h3 class="name"><strong style="color: blue">Nova Bajaj</strong></h3>
                            <h3 class="name"><strong style="color: black"> ডিলার: উত্তরা মোটরস্ লিমিটেড </strong></h3>
                            <h4 class="name"><strong style="color: red">Pirgachha, Rangpur.</strong></h4>
                            <h5 class="name">Mobile: <strong>{{$owner->mobile}},{{$owner->email}}</strong>
                            </h5>
                        </div>
                        <div class="col-3">
                        </div>
                    </div>
                </header>
                <main>
                    <div class="row contacts">
                        <div class="col invoice-to">
                            <div class="text-gray-light">
                                <h4>Ref:</h4>
                            </div>
                            <div class="text-gray-light">
                                <h4> To: The Registation Authority </h4>
                            </div>
                        </div>
                        <div class="col invoice-details">
                            <div class="date">
                                <h4> Date:
                                    <span style="border-bottom: 2px dotted">  {{date('d-m-Y', strtotime($invoice->date))}}
                                </h4> </span>
                            </div>
                        </div>

                    </div>
                    <center class="text-bold text-center">
                        <h4 style="background-color: blue; color: white; display:inline-block; padding: 10px;"> To Whome
                            It May Concern <h4>
                    </center>
                    <p style="margin: 0 !important">
                    <h4>This is to certify that we have sold new vhicle to :</h4>
                    </p>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td class="bd-dotted"> &nbsp; &nbsp; &nbsp; <h4>  {{ optional($invoice->customer)->name??' ' }} &nbsp; &nbsp; &nbsp; &nbsp;
                                        &nbsp;
                                        &nbsp; &nbsp; &nbsp; &nbsp; C/O  {{ optional($invoice->customer)->father_name??' ' }} </h4>
                                </td>
                            </tr>
                            <tr>
                                <td class="bd-dotted">&nbsp; &nbsp; <h4> ADDRESS : {{ optional($invoice->customer)->address??' ' }}  </h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p>
                    <h4>On the Following Particulars &nbsp; &nbsp; &nbsp; :</h4>
                    </p>
                    <table border="0" cellspacing="0" cellpadding="0" style="font-size: 20px">
                        <tbody>
                            <tr>
                                <td class="text-left"
                                    style="border-bottom: 2px dotted gray; padding-left: 0;padding-bottom: 5px;">
                                    <h4>
                                        <span style="width: 40%; display:inline-block">01. Model/Make Of Vehicle</span>
                                        <span style="width: 40%">
                                            :
                                            {{optional(optional($invoice->invoice_detail)->product)->model_Of_vehicle??'' }}
                                        </span>
                                    </h4>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left"
                                    style=" border-bottom: 2px dotted gray; padding-left: 0;padding-bottom: 5px; ">
                                    <h4>
                                        <span style="width: 40%; display:inline-block"> 02. Class Of Vehicle</span>
                                        <span style="width: 40%">
                                            : {{optional(optional($invoice->invoice_detail)->product)->class_Of_vehicle??' '}}
                                        </span>
                                    </h4>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left"
                                    style="border-bottom: 2px dotted gray;padding-left: 0;padding-bottom: 5px;">
                                    <h4>
                                        <span style="width: 40%; display:inline-block"> 03. Chasiss No</span>
                                        <span style="width: 40%">
                                            : {{ optional($invoice->invoice_detail)->chasiss_no??' ' }}
                                        </span>
                                    </h4>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left" style="
                      border-bottom: 2px dotted gray;
                      padding-left: 0;
                      padding-bottom: 5px;
                    ">
                                    <h4>
                                        <span style="width: 40%; display:inline-block">04. Engine No</span>
                                        <span style="width: 40%">
                                            : {{ optional($invoice->invoice_detail)->engine_no??' '}}
                                        </span>
                                    </h4>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left"
                                    style=" border-bottom: 2px dotted gray; padding-left: 0; padding-bottom: 5px;">
                                    <h4>
                                        <span style="width: 40%; display:inline-block"> 05. key No </span>
                                        <span style="width: 40%">
                                            : {{ optional( optional($invoice->invoice_detail)->product)->key_no??' ' }}
                                        </span>
                                    </h4>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left" style="
                      border-bottom: 2px dotted gray;
                      padding-left: 0;
                      padding-bottom: 5px;
                    ">
                                    <h4>
                                        <span style="width: 40%; display:inline-block">06. None Of Cylineder With CC
                                        </span>
                                        <span style="width: 40%">
                                            : {{optional(optional($invoice->invoice_detail)->product)->none_of_cylineder_with_cc??''}}
                                        </span>
                                    </h4>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left" style="
                      border-bottom: 2px dotted gray;
                      padding-left: 0;
                      padding-bottom: 5px;
                    ">

                                    <h4>
                                        <span style="width: 40%; display:inline-block"> 07. Colour Of Vehicle </span>
                                        <span style="width: 40%">
                                            : {{ optional($invoice->invoice_detail)->color??' ' }}
                                        </span>
                                    </h4>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left" style="
                      border-bottom: 2px dotted gray;
                      padding-left: 0;
                      padding-bottom: 5px;
                    ">

                                    <h4>
                                        <span style="width: 40%; display:inline-block"> 08. Size Of Tyre </span>
                                        <span style="width: 40%">
                                            :  {{ optional(optional($invoice->invoice_detail)->product)->size??' ' }}
                                        </span>
                                    </h4>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left" style="
                      border-bottom: 2px dotted gray;
                      padding-left: 0;
                      padding-bottom: 5px;
                    ">

                                    <h4>
                                        <span style="width: 40%; display:inline-block"> 09. Year Of
                                            Manufacture/Assembel</span>
                                        <span style="width: 40%">
                                            : {{ optional($invoice->invoice_detail)->year_of_manufacture??' ' }}
                                        </span>
                                    </h4>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left" style="
                      border-bottom: 2px dotted gray;
                      padding-left: 0;
                      padding-bottom: 5px;
                    ">

                                    <h4>
                                        <span style="width: 40%; display:inline-block">10. Hourse Power </span>
                                        <span style="width: 40%">
                                            : {{ optional(optional($invoice->invoice_detail)->product)->hourse_power??'' }}
                                        </span>
                                    </h4>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left" style="
                      border-bottom: 2px dotted gray;
                      padding-left: 0;
                      padding-bottom: 5px;
                    ">

                                    <h4>
                                        <span style="width: 40%; display:inline-block">11. Laden Weight </span>
                                        <span style="width: 40%">
                                            : {{ optional(optional($invoice->invoice_detail)->product)->laden_weight??'' }}
                                        </span>
                                    </h4>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left" style="
                      border-bottom: 2px dotted gray;
                      padding-left: 0;
                      padding-bottom: 5px;
                    ">
                                    <h4>
                                        <span style="width: 40%; display:inline-block"> 12. Wheel Base </span>
                                        <span style="width: 40%">
                                            : {{ optional(optional($invoice->invoice_detail)->product)->wheel_base??' '}}
                                        </span>
                                    </h4>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left" style="
                      border-bottom: 2px dotted gray;
                      padding-left: 0;
                      padding-bottom: 5px;
                    ">

                                    <h4>
                                        <span style="width: 40%; display:inline-block"> 13. Seating Capacity </span>
                                        <span style="width: 40%">
                                            : {{ optional(optional($invoice->invoice_detail)->product)->seating_capacity??' '}}
                                        </span>
                                    </h4>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left" style="
                      border-bottom: 2px dotted gray;
                      padding-left: 0;
                      padding-bottom: 5px;
                    ">

                                    <h4>
                                        <span style="width: 40%; display:inline-block"> 14. Maker's Name </span>
                                        <span style="width: 40%">
                                            : {{ optional(optional($invoice->invoice_detail)->product)->makers_Name??' '}}
                                        </span>
                                    </h4>
                                </td>
                            </tr>
                            <tr>

                                <td class="text-left" style="
                      border-bottom: 2px dotted gray;
                      padding-left: 0;
                      padding-bottom: 5px;
                    ">

                                    <h4>
                                        <span style="width: 40%; display:inline-block"> 15. Unit Price </span>
                                        <span style="width: 40%">
                                            : {{ number_format(optional(optional($invoice->invoice_detail)->product)->unit_price, 2)??' '}} TK
                                        </span>
                                    </h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </main>
                <div class="row">

                    <h4 class="col-12 text-right text-bold">For Nova Bajaj</h4>

                    <div class="col-6 text-left text-bold">
                        <span style="border-top: 1px dotted red">
                            <h4> Owner's Signature </h4>
                        </span>
                    </div>
                    <div class="col-6 text-right text-bold">
                        <span style="border-top: 1px dotted red">
                            <br>
                            <h4> Sales Department </h4>
                        </span>
                    </div>
                </div>
            </div>
            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
            <div></div>
        </div>
    </div>











    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col-3">
                        <a target="_blank" href="https://lobianijs.com">
                            <img src="{{(!empty($owner->image)) ? url('public/backend/user_images/'.$owner->image) : url('public/backend/images/noimage.png')}}"
                                style="height: 120px;width: 150px;">
                        </a>
                    </div>
                    <div class="col-6 company-details text-center">
                        <h4 class="name">Delivery Chalan </h4>
                        <h3 class="name"><strong style="color: green; font-size: 40px; ">নোভা বাজাজ</strong></h3>
                        <h3 class="name"><strong style="color: blue">Nova Bajaj</strong></h3>
                        <h3 class="name"><strong style="color: black"> ডিলার: উত্তরা মোটরস্ লিমিটেড </strong></h3>
                        <h4 class="name"><strong style="color: red">{{$owner->address}}</strong></h4>
                        <h5 class="name">Mobile: <strong>{{$owner->mobile}}, {{$owner->email}}</strong></h5>
                    </div>
                    <div class="col-3">
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">
                            <h4> Ref: </h4>
                        </div>
                        <div class="text-gray-light"></div>
                    </div>
                    <div class="col invoice-details">

                        <div class="date">
                            <h4> Date:  {{date('d-m-Y', strtotime($invoice->date)) }} </h4>
                        </div>
                    </div>
                    <!-- <div class="col-12"> -->

                    <!-- </div> -->
                </div>


                <table border="0" cellspacing="0" cellpadding="0" style="font-size: 20px">
                    <tbody>
                        <tr>
                            <td class="bd-dotted">
                                <h4> &nbsp; &nbsp; &nbsp; M/S {{ optional($invoice->customer)->name??' ' }} &nbsp;
                                    &nbsp; &nbsp; S/O &nbsp; &nbsp; &nbsp;  {{ optional($invoice->customer)->father_name??' ' }} </h4>
                            </td>
                        </tr>

                        <tr>
                            <td class="bd-dotted">&nbsp; &nbsp; <h4> ADDRESS :  {{optional($invoice->customer)->address??' ' }} </h4>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p>
                <h5> Please receive the under mentioned vehicles/with standard/Extra tools with spare wheel and
                    accessories on the following particulars. </h5>
                </p>
                <table border="0" cellspacing="0" cellpadding="0" style="font-size: 20px">
                    <tbody>
                        <tr>
                            <td class="text-left" style="
                                border-bottom: 2px dotted gray;
                                padding-left: 0;
                                padding-bottom: 5px;
                                ">

                                <h4>
                                    <span style="width: 40%; display:inline-block"> 01. Chasiss No</span>
                                    <span style="width: 40%">
                                        :{{ optional($invoice->invoice_detail)->chasiss_no??' ' }}
                                    </span>
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left" style="
                                    border-bottom: 2px dotted gray;
                                    padding-left: 0;
                                    padding-bottom: 5px;
                                    ">

                                <h4>
                                    <span style="width: 40%; display:inline-block">02. Engine No</span>
                                    <span style="width: 40%">
                                        : {{ optional($invoice->invoice_detail)->engine_no??' '}}
                                    </span>
                                </h4>

                            </td>
                        </tr>
                        <tr>
                            <td class="text-left" style="
                                border-bottom: 2px dotted gray;
                                padding-left: 0;
                                padding-bottom: 5px;
                                ">


                                <h4>
                                    <span style="width: 40%; display:inline-block"> 03. key No </span>
                                    <span style="width: 40%">
                                        : {{ optional( optional($invoice->invoice_detail)->product)->key_no??' ' }}
                                    </span>
                                </h4>

                            </td>
                        </tr>
                        <tr>
                            <td class="text-left" style="
                                    border-bottom: 2px dotted gray;
                                    padding-left: 0;
                                    padding-bottom: 5px;
                                ">

                                <h4>
                                    <span style="width: 40%; display:inline-block">04. Model/Make Of Vehicle</span>
                                    <span style="width: 40%">
                                        : {{ optional( optional($invoice->invoice_detail)->product)->model_Of_vehicle??' ' }}
                                    </span>
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left" style="
                                border-bottom: 2px dotted gray;
                                padding-left: 0;
                                padding-bottom: 5px;
                                ">

                                <h4>
                                    <span style="width: 40%; display:inline-block">05. Year Of Manufacture/Assembel
                                    </span>
                                    <span style="width: 40%">
                                        : {{ optional( optional($invoice->invoice_detail)->product)->year_of_manufacture??' ' }}
                                    </span>
                                </h4>



                            </td>
                        </tr>
                        <tr>
                            <td class="text-left" style="
                                    border-bottom: 2px dotted gray;
                                    padding-left: 0;
                                    padding-bottom: 5px;
                                    ">

                                <h4>
                                    <span style="width: 40%; display:inline-block">06. None Of Cylineder With CC
                                    </span>
                                    <span style="width: 40%">
                                        : {{optional(optional($invoice->invoice_detail)->product)->none_of_cylineder_with_cc??'' }}
                                    </span>
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left" style="
                                border-bottom: 2px dotted gray;
                                padding-left: 0;
                                padding-bottom: 5px;
                                ">


                                <h4>
                                    <span style="width: 40%; display:inline-block"> 07. Seating Capacity </span>
                                    <span style="width: 40%">
                                        : {{optional(optional($invoice->invoice_detail)->product)->seating_capacity??' '}}
                                    </span>
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left" style="
                                border-bottom: 2px dotted gray;
                                padding-left: 0;
                                padding-bottom: 5px;
                                ">

                                <h4>
                                    <span style="width: 40%; display:inline-block"> 08. Class Of Vehicle</span>
                                    <span style="width: 40%">
                                        : {{ optional(optional($invoice->invoice_detail)->product)->class_Of_vehicle??' '}}
                                    </span>
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left" style="
                                border-bottom: 2px dotted gray;
                                padding-left: 0;
                                padding-bottom: 5px;
                                ">

                                <h4>
                                    <span style="width: 40%; display:inline-block"> 09. Colour Of Vehicle</span>
                                    <span style="width: 40%">
                                        : {{   optional($invoice->invoice_detail)->color??' ' }}
                                    </span>
                                </h4>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left" style="
                                border-bottom: 2px dotted gray;
                                padding-left: 0;
                                padding-bottom: 5px;
                                ">

                                <h4>
                                    <span style="width: 40%; display:inline-block"> 10. Size Of Tyre </span>
                                    <span style="width: 40%">
                                        : {{ optional(optional($invoice->invoice_detail)->product)->size??' ' }}
                                    </span>
                                </h4>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>

                <div class="col-12" style="border:2px solid #3989c6; height: 200px; width: 100%; ">
                    <h4> Remarks: </h4>
                </div>
                <br>

                <h5>Receive with thanks the above mentined vehicle(s) woth perfect condition along with tools and
                    accessories </h5>

                <br> <br>
            </main>

            <div class="row">


                <h4 class="col-12 text-right text-bold">For Nova Bajaj</h4>
                <div class="col-6 text-left text-bold">
                    <span style="border-top: 1px dotted red">
                        <h4> Owner's Signature </h4>
                    </span>
                </div>
                <div class="col-6 text-right text-bold">
                    <span style="border-top: 1px dotted red">
                        <br>
                        <h4> Sales Department </h4>
                    </span>
                </div>
            </div>


        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
    </div>

    <div id="invoice">
        <br>
        <br>
        <div class="invoice overflow-auto">
            <div style="min-width: 600px">
                <div class="row">
                    <div class="col-12 company-details text-center">
                        <h4 class="name">
                            <strong style="font-size: 25px; ">FORM OF APPLICATION FOR THE REGISTRATION OF MOTOR
                                VEHICLE</strong>
                        </h4>
                        <h5 class="name">
                            <strong class="col-12" style="font-size: 25px; "> <u>To be filled in by the office</u>
                            </strong>
                        </h5>
                        <h4 class="name"><strong>Section-I</strong></h4>
                        <br>
                    </div>


                    <div class="col-4" style="text-align: left; font-size: 17px">
                        <div class="text-gray-light"> <strong> Regn No: </strong> </div>
                        <div class="text-gray-light"> <strong> Issue No: </strong> </div>
                        <div class="text-gray-light"> <strong> Diary No: </strong> </div>
                        <div class="text-gray-light"> <strong> Customer ID: </strong> </div>
                        <div class="text-gray-light"> <strong> Veh. Description: </strong> </div>
                        <div class="text-gray-light"> <strong> Refusal date: </strong> </div>
                        <div class="text-gray-light"> <strong> P.O./Bank: </strong> </div>
                        <div class="text-gray-light"> <strong> Remarks (if any) </strong> </div>
                    </div>

                    <div class="col-4" style="text-align: left; font-size: 17px">
                        <div class="text-gray-light"> <strong> Date: </strong> </div>
                        <div class="text-gray-light"> <strong> Date: </strong> </div>
                        <div class="text-gray-light"> <strong> Date: </strong> </div>
                        <div class="text-gray-light"> <strong> District: </strong> </div>
                        <br>
                        <div class="text-gray-light"> <strong> Refusal Code: </strong> </div>
                    </div>

                    <div class="col-4" style="text-align: left; font-size: 17px">
                        <div class="text-gray-light"> <strong> Prev. Regn. No. (If any) </strong> </div>
                        <div class="text-gray-light"> <strong> Issue by: </strong> </div>
                        <div class="text-gray-light"> <strong> Received by: </strong> </div>
                        <div class="text-gray-light"> <strong> Vehicle ID: </strong> </div>
                        <div class="text-gray-light"> <strong> Call non date: </strong> </div>
                        <div class="text-gray-light"> <strong> Refused by: </strong> </div>
                        <div class="text-gray-light"> <strong> Index No. </strong> </div>
                    </div>

                    <center class="text-bold text-center col-12">
                        <h5>
                            <strong> <u> To be filled in by the Owner </u> </strong>
                        </h5>
                        <h4 class="name"><strong>Section-II</strong></h4>
                        <h5><strong> (Owner information) </strong></h5>
                    </center>

                    <div class="col-6" style="text-align: left; font-size: 17px">
                        <div class="text-gray-light"> <strong> 01. Name of owner : {{optional($invoice->customer)->name??' ' }} </strong> </div>
                        <div class="text-gray-light"> <strong> 03. Father/Husband : {{optional($invoice->customer)->father_name??' ' }} </strong> </div>
                        <div class="text-gray-light"> <strong> 05. Sex : Male </strong> </div>
                        <div class="text-gray-light"> <strong> 07. Owner’s Address (One only) :  {{optional($invoice->customer)->address??' ' }} </strong> </div>
                        <div class="text-gray-light"> <strong> 08. Phone No. (If any) : {{optional($invoice->customer)->mobile??' ' }}  </strong> </div>
                        <div class="text-gray-light"> <strong> 13. Hire : NO </strong> </div>
                    </div>

                    <div class="col-6" style="text-align: left; font-size: 17px">
                        <div class="text-gray-light"> <strong> 02. Date of birth : </strong> </div>
                        <div class="text-gray-light"> <strong> 04. Nationality : BANGLADESHI </strong> </div>
                        <div class="text-gray-light"> <strong> 06. Guardian’s name : NO </strong> </div>
                        <br>
                        <div class="text-gray-light"> <strong> 11. Owner type : PRIVATE </strong> </div>
                        <div class="text-gray-light"> <strong> 14. Hire purchase: NO </strong> </div>
                    </div>
                    <center class="text-bold text-center col-12">
                        <h5>
                            <strong> <u> To be filled in by the Owner </u> </strong>
                        </h5>
                        <h4 class="name"><strong>Section III</strong></h4>
                        <h5><strong> (Owner information) </strong></h5>
                    </center>

                    <div class="col-6" style="text-align: left; font-size: 17px">
                        <div class="text-gray-light"> <strong> 14. Vehicle or trailer : VEHICLE </strong> </div>
                        <div class="text-gray-light">
                            <strong> 14. Class of vehicle : MOTORCYCLE </strong>
                        </div>
                        <div class="text-gray-light"> <strong> 16. Type of body : MOTORCYCLE </strong> </div>
                        <div class="text-gray-light"> <strong> 18. Color (cabin/body) : {{optional($invoice->invoice_detail)->color??' ' }} </strong> </div>
                        <div class="text-gray-light">
                            <strong> 20. Number of cylinders: 01 CYLINDER </strong>
                        </div>
                        <div class="text-gray-light"> <strong> 22. Engine number : {{
                                optional($invoice->invoice_detail)->engine_no??' ' }} </strong>
                        </div>
                        <div class="text-gray-light"> <strong> 24. Horse power : {{
                                optional(optional($invoice->invoice_detail)->product)->hourse_power??' ' }} </strong>
                        </div>
                        <div class="text-gray-light"> <strong> 26. Cubic capacity : {{
                                optional(optional($invoice->invoice_detail)->product)->seating_capacity??' ' }}
                            </strong> </div>
                        <div class="text-gray-light"> <strong> 28. No. of Standee : </strong> </div>
                        <div class="text-gray-light"> <strong> 30. Unladen weight (kg) {{
                                optional(optional($invoice->invoice_detail)->product)->laden_weight }} </strong> </div>
                    </div>

                    <div class="col-6" style="text-align: left; font-size: 17px">
                        <div class="text-gray-light">
                            <strong> 15. Prev. Regn. No. (If any) : NEW </strong>
                        </div>
                        <div class="text-gray-light">
                            <strong> 15a. Maker’s name: BAJAJ AUTO LTD. INDIA </strong>
                        </div>
                        <div class="text-gray-light"> <strong> 17. Maker’s Country : INDIA </strong> </div>
                        <div class="text-gray-light"> <strong> 19. Year of manufacture : {{
                                optional($invoice->invoice_detail)->year_of_manufacture??' ' }}
                            </strong> </div>
                        <div class="text-gray-light"> <strong> 21. Chassis number : {{
                                optional($invoice->invoice_detail)->chasiss_no??' ' }} </strong>
                        </div>
                        <div class="text-gray-light"> <strong> 23. Fuel used : PETROL </strong> </div>
                        <div class="text-gray-light"> <strong> 25. RPM : {{
                                optional(optional($invoice->invoice_detail)->product)->hourse_power??' ' }} </strong>
                        </div>
                        <div class="text-gray-light">
                            <strong> 27. Seats (incl. driver):2 PERSON </strong>
                        </div>
                        <div class="text-gray-light"> <strong> 29. Wheel base : {{
                                optional(optional($invoice->invoice_detail)->product)->wheel_base??' ' }} </strong>
                        </div>
                        <div class="text-gray-light">
                            <strong> 31. Maximum laden/train weight (kg) : </strong>
                        </div>
                    </div>
                    <br>

                    <center class="text-bold text-center col-12">
                        <h4 class="name"><strong>Section IV</strong></h4>
                        <h5>
                            <strong>
                                (Additional information for transport vehicle)
                            </strong>
                        </h5>
                    </center>

                    <div class="col-6" style="text-align: left; font-size: 17px">
                        <div class="text-gray-light"> <strong> 32. No. of types : 02 TWO </strong> </div>
                        <div class="text-gray-light"> <strong> 34. No. of axle &nbsp : 02 TWO </strong> </div>
                        <br>
                        <br>
                        <br>
                    </div>

                    <div class="col-6" style="text-align: left; font-size: 17px">
                        <div class="text-gray-light"> <strong> 33. Tyres size : &nbsp; R: {{ optional(optional($invoice->invoice_detail)->product)->size??' ' }} </strong> </div>
                        <div class="text-gray-light"> <strong> 35. Maximum axle weight (kg) : </strong> </div>
                        <div class="text-gray-light">
                            <strong> a) Front axle &nbsp; (1) &nbsp; (2) </strong>
                        </div>
                        <div class="text-gray-light">
                            <strong> b) Central axle &nbsp; (1) &nbsp; (2) &nbsp; (3) </strong>
                        </div>
                        <div class="text-gray-light">
                            <strong> c) Rear axle &nbsp; (1) &nbsp; (2) &nbsp; (3) </strong>
                        </div>

                    </div>

                    <div class="col-12" style="text-align: left; font-size: 17px">
                        <div class="text-gray-light">
                            <strong> 36. Dimensions (mm) : </strong> <br>

                            &nbsp; <strong> a) Overall length </strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <strong> b) Overall width </strong> &nbsp; &nbsp;
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <strong> c)
                                Overall height </strong>
                        </div>

                        <div class="text-gray-light">
                            <strong> 37. Overhangs (%) </strong> <br>

                            &nbsp; <strong> a) Front </strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            &nbsp; <strong> b) Rear </strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            &nbsp; <strong> c) Other </strong>
                        </div>
                    </div>

                    <div class="col-12 pagebreak" style="page-break-after: always;text-align: justify; font-size: 17px;">
                        <strong> 38. A copy of the drawing showing the vehicle dimension
                            specifications of the body and the seating arrangements approved
                            by ....................................................on.
                            ............................................. is attached herewith. </strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="invoice " style="margin-top: 300pxs; page-break-before: always">
            <div style="min-width: 600px">
                <div class="row">
                    <div class="col-12 company-details text-center">
                        <h4 class="name"><strong>Section-V</strong></h4>
                        <br>
                    </div>

                    <div class="col-8" style="text-align: left; font-size: 17px">
                        <div class="text-gray-light">
                            <strong> 39. Hire purchase/hypothecation information: </strong>
                        </div>
                        <div class="text-gray-light">
                            <strong> &nbsp; The vehicle is subject to hire purchase/hypothecation with : </strong>
                        </div>
                        <div class="text-gray-light">&nbsp; <strong> a) Name : </strong> </div>
                        <div class="text-gray-light">&nbsp; <strong> c) Address : </strong> </div>
                    </div>

                    <div class="col-4" style="text-align: left; font-size: 17px">
                        <br>
                        <br>
                        <div class="text-gray-light"> <strong> b) Date : </strong> </div>
                    </div>

                    <div class="col-8" style="text-align: left; font-size: 17px">
                        <div class="text-gray-light"> <strong> 40. Insurance information : </strong> </div>
                        <div class="text-gray-light">
                            <strong> a) Policy no: </strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            &nbsp; &nbsp; <strong> b) Type of policy : </strong>
                        </div>
                        <div class="text-gray-light"> <strong> d) Date of expiry : </strong> </div>
                    </div>

                    <div class="col-4" style="text-align: left; font-size: 17px">
                        <br>
                        <div class="text-gray-light">
                            <strong> c) Insurer’s name &amp; address : </strong>
                        </div>
                    </div>

                    <div class="col-8" style="text-align: left; font-size: 17px">
                        <div class="text-gray-light"> <strong> 41. Joint owner information : </strong> </div>
                        <div class="text-gray-light"> <strong> a) Name : </strong></div>
                        <div class="text-gray-light">&nbsp; <strong> Father/Husband : </strong> </div>
                    </div>

                    <div class="col-4" style="text-align: left; font-size: 17px">
                        <br>
                        <div class="text-gray-light"> <strong> b) Name :</strong> </div>
                        <div class="text-gray-light"> <strong> &nbsp; Father/Husband : </strong> </div>
                    </div>

                    <div class="col-12 company-details text-center">
                        <h4 class="name"><strong>Section-VI </strong></h4>
                        <h5 class="name">
                            <strong> (Declaration, Certificates and documents) </strong>
                        </h5>
                    </div>

                    <div class="col-12" style="text-align: justify; font-size: 17px">
                        <div class="text-gray-light"> <strong> 42. Declaration by owner : </strong> </div>
                        <div class="text-gray-light">
                            <strong>

                                &nbsp; a) I the undersigned do hereby declare that to the best
                                of my knowledge and belief, the information given and the
                                documents enclosed (as per list attached) are true. I also declare that in case the
                                papers/documents and
                                information furnished are found to be incorrect at any later
                                stage, I shall be liable for legal action.

                            </strong>

                        </div>
                    </div>

                    <div class="col-8" style="text-align: justify; font-size: 17px"></div>
                    <div class="col-4" style="
                text-align: center;
                font-size: 17px;
                margin-top: 40px;
                border-top: 1px dotted gray;
              ">
                        <div class="text-gray-light"> <strong> Signature of owner </strong> </div>
                        <div class="text-gray-light"> <strong> Seal </strong> </div>
                    </div>

                    <div class="col-12" style="text-align: justify; font-size: 17px">
                        <div class="text-gray-light"> <strong> Date : </strong> </div>
                        <div class="text-gray-light"> <strong> Encl : List of documents </strong> </div>
                        <div class="text-gray-light">
                            <strong> 43. Registered dealer’s certificate: </strong>
                        </div>
                        <div class="text-gray-light">
                            <strong> &nbsp; I the undersigned do hereby certify that the vehicle in
                                question has been sold by me/my firm and the ownership documents
                                attached with the application for registration are true. The
                                information/specifications pertaining to the vehicle are correct
                                and the vehicle complies with all the requirements of the
                                registration. </strong>
                        </div>
                    </div>

                    <div class="col-8" style="text-align: justify; font-size: 17px"></div>
                    <div class="col-4" style="
                text-align: center;
                font-size: 17px;
                margin-top: 40px;
                border-top: 1px dotted gray;
              ">
                        <div class="text-gray-light"> <strong> Signature of registered dealer </strong> </div>
                        <div class="text-gray-light"> <strong> Seal </strong> </div>
                    </div>

                    <div class="col-12" style="text-align: justify; font-size: 17px">
                        <div class="text-gray-light"> <strong> Date : </strong> </div>
                        <div class="text-gray-light"> <strong> Encl : List of documents </strong> </div>
                        <div class="text-gray-light">
                            <strong> 44. Certificate by the Inspector of Motor Vehicles : </strong>
                        </div>
                        <div class="text-gray-light">
                            <strong> Certificate that the particulars pertaining to the owner and the
                                vehicle (Chassis No
                                <span class="col-1" style="border-bottom: 2px dotted; width: 100%"> {{
                                    optional($invoice->invoice_detail)->chasiss_no??' ' }} </span>
                            </strong>

                            <strong>
                                Engine
                                No
                            </strong> <span class="col-1" style="border-bottom: 2px dotted; width: 100%">

                                <strong>{{optional($invoice->invoice_detail)->engine_no??' ' }}</strong>
                            </span> )
                            given in the application match with the ownership documents
                            attached to this application. It is further certified that the
                            vehicle complies with the registration requirements specified in
                            the MV Act and the Rules and/or Regulations made there under and
                            the vehicle is not mechanically defective. The necessary
                            documents/papers are available as per list enclosed. </strong>
                        </div>
                    </div>

                    <div class="col-4" style="text-align: left; font-size: 17px">
                        <div class="text-gray-light"> <strong> Date : </strong> </div>
                        <div class="text-gray-light"> <strong> Encl : List of documents </strong> </div>
                    </div>

                    <div class="col-4" style="text-align: justify; font-size: 17px"></div>
                    <div class="col-4" style="
                text-align: center;
                font-size: 17px;
                margin-top: 40px;
                border-top: 1px dotted gray;
              ">
                        <div class="text-gray-light">
                            <strong> Signature of Inspector of Motor Vehicles </strong>
                        </div>
                        <div class="text-gray-light"> <strong> Official Seal </strong> </div>
                    </div>

                    <div class="col-4" style="text-align: left; font-size: 17px">
                        <div class="text-gray-light"> <strong> 45. Registration Status : </strong> </div>
                        <div class="text-gray-light">
                            &nbsp; <strong> Registration allowed/not allowed </strong>
                        </div>
                    </div>

                    <div class="col-4" style="text-align: justify; font-size: 17px"></div>
                    <div class="col-4" style="
                text-align: center;
                font-size: 17px;
                margin-top: 40px;
                border-top: 1px dotted gray;
              ">
                        <div class="text-gray-light">
                            <strong> Signature of Registering Authority </strong>
                        </div>
                        <div class="text-gray-light"> <strong> Seal </strong> </div>
                    </div>

                    <div class="col-12" style="text-align: justify; font-size: 17px">
                        <div class="text-gray-light"> <strong> 46. Fees and Tax Accounts : </strong> </div>
                        <div class="text-gray-light">
                            &nbsp; <strong> Necessary fees and taxes amounting to
                                taka..............................................................................has
                                been paid to PO/Bank. vide vouchers and receipts enclosed. </strong>
                        </div>
                    </div>

                    <div class="col-4" style="
                text-align: left;
                font-size: 17px;
                text-align: center;
                font-size: 17px;
                margin-top: 40px;
                border-top: 1px dotted gray;
              ">
                        <div class="text-gray-light">
                            &nbsp; &nbsp; <strong> Signature of owner </strong>
                        </div>
                        <div class="text-gray-light">
                            &nbsp; &nbsp; <strong> of his representative </strong>
                        </div>
                    </div>

                    <div class="col-4" style="
                text-align: justify;
                font-size: 17px;
                text-align: center;
                font-size: 17px;
              "></div>
                    <div class="col-4" style="
                text-align: center;
                font-size: 17px;
                text-align: center;
                font-size: 17px;
                margin-top: 40px;
                border-top: 1px dotted gray;
              ">
                        <div class="text-gray-light"> <strong> Signature of dealing assistant </strong> </div>
                    </div>

                    <div class="col-12" style="text-align: center; font-size: 17px">
                        <div class="text-gray-light">
                            <strong> Counter signature by the registering authority. </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="invoice overflow-auto" style="margin-top: 300px;">>
            <div style="min-width: 600px">
                <div class="row">

                    <div class="col-2"></div>
                    <div class="col-8 company-details text-center">
                        <h2 class="name"><strong> OWNER’S PARTICULARS/SPECIMEN SIGNATURE </strong></h2>
                    </div>
                    <div class="col-2"
                        style="border:2px solid #3989c6; height: 200px; width: 200px; text-align: center; font-size: 18px;  ">
                        <p>Stamp Size Color Pic</p>
                    </div>
                    <div class="col-12" style="font-size: 30px;">
                        <div class="text-gray-light text-left row">

                            <span class="col-4">01. NAME</span>
                            <span class="col-1 text-right">:</span>
                            <span class="col-7 ">{{ optional($invoice->customer)->name??' ' }}</span>
                        </div>
                    </div>



                    <div class="col-12" style="font-size: 30px;">
                        <div class="text-gray-light text-left row">
                            <span class="col-4">02. FATHER/ HUSBAND </span>
                            <span class="col-1 text-right">:</span>
                            <span class="col-7 ">{{ optional($invoice->customer)->father_name??' ' }}</span>
                        </div>
                    </div>

                    <div class="col-12" style="font-size: 30px;">
                        <div class="text-gray-light text-left row">
                            <span class="col-4">03. Mobile </span>
                            <span class="col-1 text-right">:</span>
                            <span class="col-7 ">{{ optional($invoice->customer)->mobile??' ' }}</span>
                        </div>
                    </div>


                    <div class="col-12" style="font-size: 30px;">
                        <div class="text-gray-light text-left row">
                            <span class="col-4">04. Address </span>
                            <span class="col-1 text-right">:</span>
                            <span class="col-7 ">{{ optional($invoice->customer)->address??' ' }}</span>
                        </div>
                    </div>


                    <div class="col-12" style="font-size: 30px;">
                        <div class="text-gray-light text-left row">
                            <span class="col-4">05. SEX </span>
                            <span class="col-1 text-right">:</span>
                            <span class="col-7 ">MALE</span>
                        </div>
                    </div>


                    <div class="col-12" style="font-size: 30px;">
                        <div class="text-gray-light text-left row">
                            <span class="col-4">06. NATIONALITY </span>
                            <span class="col-1 text-right">:</span>
                            <span class="col-7 ">BANGLADESHI</span>
                        </div>
                    </div>



                    <div class="col-12" style="font-size: 30px;">
                        <div class="text-gray-light text-left row">
                            <span class="col-4">07. DATE OF BIRTH </span>
                            <span class="col-1 text-right">:</span>
                            <span class="col-7 "></span>
                        </div>

                    </div>



                    <div class="col-12" style="font-size: 30px;">
                        <div class="text-gray-light text-left row">
                            <span class="col-4">08. GUARDIAN’S NAME </span>
                            <span class="col-1 text-right">:</span>
                            <span class="col-7 ">NO</span>
                        </div>
                    </div>



                    <div class="col-12" style="font-size: 30px;">
                        <div class="text-gray-light text-left row">
                            <span class="col-4">09. CHASSIS NO </span>
                            <span class="col-1 text-right">:</span>
                            <span class="col-7 "> {{optional($invoice->invoice_detail)->chasiss_no??' ' }}</span>
                        </div>
                    </div>


                    <div class="col-12" style="font-size: 30px;">
                        <div class="text-gray-light text-left row">
                            <span class="col-4">10. ENGINE NO</span>
                            <span class="col-1 text-right">:</span>
                            <span class="col-7 "> {{optional($invoice->invoice_detail)->engine_no??' ' }}</span>
                        </div>
                    </div>

                    <div class="col-12" style="font-size: 30px;">
                        <div class="text-gray-light text-left row">
                            <span class="col-4">11. YEAR OF MFG</span>
                            <span class="col-1 text-right">:</span>
                            <span class="col-7 "> {{optional($invoice->invoice_detail)->year_of_manufacture??' ' }}</span>
                        </div>
                    </div>

                    <div class="col-12" style="font-size: 30px;">
                        <div class="text-gray-light text-left row">
                            <span class="col-4">12. PREV. REGN. NO. (IF ANY) </span>
                            <span class="col-1 text-right">:</span>
                            <span class="col-7 "> NEW</span>
                        </div>
                    </div>



                    <div class="col-12" style="font-size: 30px;">
                        <div class="text-gray-light text-left row">
                            <span class="col-4">13. P.O./BANK</span>
                            <span class="col-1 text-right">:</span>
                            <span class="col-7 "> NEW</span>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>

                    <div class="col-12" style="font-size: 30px;">
                        <div class="text-gray-light text-left">
                            <h3> &nbsp; &nbsp; &nbsp; <u> SPECIMEN SIGNATURE </u> </h3>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>


                    <div class="col-1"> </div>
                    <br>
                    <br>

                    <small style="font-size: 30px;"> 1. </small> &nbsp;
                    <div class="col-4"style="border:2px solid #3989c6; height: 110px; width: 50px; text-align: center; "></div>

                    <div class="col-2"> </div>

                    <small style="font-size: 30px; "> 2. </small> &nbsp;
                    <div class="col-4"
                        style="border:2px solid #3989c6; height: 110px; width: 50px; text-align: center;  ">
                    </div>

                    <br> <br> <br>

                    <br> <br> <br>
                    <br> <br> <br>




                    <div class="col-1"> </div>


                    <small style="font-size: 30px; "> 3. </small> &nbsp;
                    <div class="col-4"
                        style="border:2px solid #3989c6; height: 110px; width: 50px; text-align: center; "></div>

                    <div class="col-2"> </div>

                    <small style="font-size: 30px;"> 4. </small> &nbsp;
                    <div class="col-4"
                        style="border:2px solid #3989c6; height: 110px; width: 50px; text-align: center;  ">
                    </div>
                    <div class="col-1"> </div>




                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>

    <script>
        $("#printInvoice").click(function () {
            Popup($(".invoice")[0].outerHTML);
            function Popup(data) {
                window.print();
                return true;
            }
        });
    </script>
</body>

</html>
