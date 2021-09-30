
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
  </head>
  <style>
    #invoice {
      padding: 30px;
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

    .invoice table tbody tr:last-child td {
      /* border: none; */
    }

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
      .bg-desing {
        border: 0 !important;
        font-weight: 600;
      }

      .invoice {
        font-size: 13px !important;
        overflow: hidden !important;
      }


      footer {
        /* position: absolute; */
        margin-top:400px !important;
        page-break-after: always;
      }
      .invoice footer {
        /* position: absolute; */
        /* margin-top: 100px; */
        /* page-break-after: always; */
      }

      .invoice > div:last-child {
        /* page-break-before: always; */
      }
      .hidden-print {
        display: none !important;
      }
      .pagebreak{
        page-break-after: always !important;
      }
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
              <div class="col-md-3 bg-desing">
                <a target="_blank" href="https://lobianijs.com">
                  <img width="300px" />
                </a>
              </div>
              <div class="col-md-6 company-details text-center">
                <h2 class="name"><strong>Company Name</strong></h2>
                <h4 class="name"><strong>Delar : Company Name</strong></h4>
                <address>Address : Address will be here..</address>
              </div>
              <div class="col-md-3 bg-desing">
                <p>1234567890</p>
                <p>1234567890</p>
                <p>email@email.com</p>
              </div>
            </div>
          </header>
          <main>
            <div class="row contacts">
              <div class="col invoice-to">
                <div class="text-gray-light">Ref:</div>
              </div>
              <div class="col invoice-details">
                <div class="date">
                  Date:
                  <span style="border-bottom: 2px dotted">{{ $invoice->date }}</span>
                </div>
              </div>
              <!-- <div class="col-md-12"> -->

              <!-- </div> -->
            </div>
            <center class="text-bold text-center">
              <h4 style="background-color: red">Motorcycle Sell Receipt</h4>
            </center>
            <section class="row">
              <div class="col-md-6">
                <p
                  class=""
                  style="
                    color: red !important;
                    -webkit-print-color-adjust: exact;
                    border-bottom: 2px dotted red;
                    font-weight: 600;
                  "
                  s
                >
                  Buyer Introduction :
                </p>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">Buyer Name :</td>
                    <td style="width: 100%; padding-left:2px ">
                        {{ optional($invoice->customer)->name??' ' }}
                    </td>
                  </tr>
                </table>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">Father's Name :</td>
                    <td style="width: 100%;  padding-left:2px ">
                    {{ optional($invoice->customer)->father_name??' ' }}
                    </td>
                  </tr>
                </table>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">Mother's Name :</td>
                    <td style="width: 100%;  padding-left:2px ">
                    {{ optional($invoice->customer)->mother_name??' ' }}

                    </td>
                  </tr>
                </table>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">Village Name :</td>
                    <td style="width: 100%;  padding-left:2px ">
                    {{ optional($invoice->customer)->village??' ' }}

                    </td>
                  </tr>
                </table>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">Post Office :</td>
                    <td style="width: 100%;  padding-left:2px ">
                    {{ optional($invoice->customer)->post_office??' ' }}

                    </td>
                  </tr>
                </table>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">District Name :</td>
                    <td style="width: 100%;  padding-left:2px ">
                    {{ optional($invoice->customer)->district??' ' }}

                    </td>
                  </tr>
                </table>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">Mobile No :</td>
                    <td style="width: 100%;  padding-left:2px ">
                    {{ optional($invoice->customer)->mobile??' ' }}

                    </td>
                  </tr>
                </table>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">Additional :</td>
                    <td style="width: 100%;  padding-left:2px ">

                    </td>
                  </tr>
                </table>
              </div>
              <div class="col-md-6">
                <p
                  class=""
                  style="
                    color: red !important;
                    -webkit-print-color-adjust: exact;
                    border-bottom: 2px dotted red;
                    font-weight: 600;
                  "
                >
                  Seller Introduction :
                </p>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">Seller Name :</td>
                    <td style="width: 100%;  padding-left:2px ">

                    </td>
                  </tr>
                </table>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">Father's Name :</td>
                    <td style="width: 100%;  padding-left:2px ">

                    </td>
                  </tr>
                </table>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">Mother's Name :</td>
                    <td style="width: 100%;  padding-left:2px ">

                    </td>
                  </tr>
                </table>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">Village Name :</td>
                    <td style="width: 100%;  padding-left:2px ">

                    </td>
                  </tr>
                </table>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">Post Office :</td>
                    <td style="width: 100%;  padding-left:2px ">

                    </td>
                  </tr>
                </table>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">District Name :</td>
                    <td style="width: 100%;  padding-left:2px ">

                    </td>
                  </tr>
                </table>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">Mobile No :</td>
                    <td style="width: 100%;  padding-left:2px ">

                    </td>
                  </tr>
                </table>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">Additional :</td>
                    <td style="width: 100%;  padding-left:2px ">
                     
                    </td>
                  </tr>
                </table>
              </div>
            </section>

            <section class="row">
              <div class="col-md-6">
                <p
                  class=""
                  style="
                    color: red !important;
                    -webkit-print-color-adjust: exact;
                    border-bottom: 2px dotted red;
                    font-weight: 600;
                  "
                  s
                >
                  About Of Motorcycle :
                </p>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">Model Name :</td>
                    <td style="width: 100%;  padding-left:2px ">
                      {{ optional(optional($invoice->invoice_detail)->product)->model_Of_vehicle??' ' }}
                    </td>
                  </tr>
                </table>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">Chassis No :</td>
                    <td style="width: 100%;  padding-left:2px ">
                        {{ optional(optional($invoice->invoice_detail)->product)->chasiss_no??' ' }}

                    </td>
                  </tr>
                </table>

                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">Engine No :</td>
                    <td style="width: 100%;  padding-left:2px ">
                    {{ optional(optional($invoice->invoice_detail)->product)->engine_no??' ' }}

                    </td>
                  </tr>
                </table>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">Color Name :</td>
                    <td style="width: 100%;  padding-left:2px ">
                    {{ optional(optional($invoice->invoice_detail)->product)->colour??' ' }}

                    </td>
                  </tr>
                </table>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">Weight :</td>
                    <td style="width: 100%;  padding-left:2px ">
                    {{ optional(optional($invoice->invoice_detail)->product)->laden_weight }}

                    </td>
                  </tr>
                </table>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">CC :</td>
                    <td style="width: 100%;  padding-left:2px ">
                    {{ optional(optional($invoice->invoice_detail)->product)->none_of_cylineder_with_cc??' ' }}

                    </td>
                  </tr>
                </table>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">Seating Capacity :</td>
                    <td style="width: 100%;  padding-left:2px ">
                    {{ optional(optional($invoice->invoice_detail)->product)->seating_capacity??' ' }}
                    </td>
                  </tr>
                </table>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">Manufacturer :</td>
                    <td style="width: 100%;  padding-left:2px ">
                    {{ optional(optional($invoice->invoice_detail)->product)->year_of_manufacture??' ' }}

                    </td>
                  </tr>
                </table>
              </div>
              <div class="col-md-6">
                <p
                  class=""
                  style="
                    color: red !important;
                    -webkit-print-color-adjust: exact;
                    border-bottom: 2px dotted red;
                    font-weight: 600;
                  "
                  s
                >
                  Amount Description :
                </p>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">Sell's Amount :</td>
                    <td style="width: 100%;  padding-left:2px ">
                      {{ $invoice->total_amount??' ' }}
                    </td>
                  </tr>
                </table>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">Intertest Amount :</td>
                    <td style="width: 100%;  padding-left:2px ">
                    {{ $invoice->intertest_amount??' ' }}
                    </td>
                  </tr>
                </table>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">Total Amount :</td>
                    <td style="width: 100%;  padding-left:2px ">
                        {{ $invoice->grand_total??' ' }}
                    </td>
                  </tr>
                </table>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">Paid Amount :</td>
                    <td style="width: 100%;  padding-left:2px ">
                    {{ $invoice->paid_amount??' ' }}
                    </td>
                  </tr>
                </table>
                <table cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="col-md-3 bg-desing">Due Amount :</td>
                    <td style="width: 100%;  padding-left:2px ">
                    {{ $invoice->due_amount??' ' }}
                    </td>
                  </tr>
                </table>
                <p
                  class="bg-desing"
                  style="width: 40%; background: #c7bcbc; padding: 1%"
                >
                  Installment Amount & Date :
                </p>
                @forelse ($invoice->installment as $key=> $installment)
                    <table cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="col-md-3 bg-desing">{{ $key+1 }} Installment :</td>
                        <td style="width: 50%;  padding-left:2px ">
                            Date : {{ $installment->date }} Interest: {{ $installment->interest }}
                        </td>
                        <td style="width: 50%;  padding-left:2px ">
                        {{ $installment->amount }} Tk
                        </td>
                    </tr>
                    </table>
                @empty

                @endforelse



              </div>
            </section>
          </main>
          <footer class="row">
            <p class="col-md-12 text-center text-bold">For company name</p>
            <div class="col-md-4 text-left text-bold">
              <span style="border-top: 1px dotted red">
                Buyer's Signature
              </span>
            </div>
            <div class="col-md-4 text-center text-bold">
              <span style="border-top: 1px dotted red">
                Owner's Signature
              </span>
            </div>
            <div class="col-md-4 text-right text-bold">
              <span style="border-top: 1px dotted red">Sell's Signature</span>
            </div>
          </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
      </div>
    </div>
    <div id="invoice">

      <div class="invoice overflow-auto">
        <div style="min-width: 600px">
          <div class="row">
            <div class="col-md-12 company-details text-center">
              <h4 class="name">
                <strong>FORM OF APPLICATION FOR THE REGISTRATION OF MOTOR
                  VEHICLE</strong>
              </h4>
              <h5 class="name">
                <strong> <u>To be filled in by the office</u> </strong>
              </h5>
              <h4 class="name"><strong>Section-I</strong></h4>
              <br>
            </div>

            <div class="col-md-4" style="text-align: left; font-size: 17px">
              <div class="text-gray-light">Regn No:</div>
              <div class="text-gray-light">Issue No:</div>
              <div class="text-gray-light">Diary No:</div>
              <div class="text-gray-light">Customer ID:</div>
              <div class="text-gray-light">Veh. Description:</div>
              <div class="text-gray-light">Refusal date:</div>
              <div class="text-gray-light">P.O./Bank:</div>
              <div class="text-gray-light">Remarks (if any)</div>
            </div>

            <div class="col-md-4" style="text-align: left; font-size: 17px">
              <div class="text-gray-light">Date:</div>
              <div class="text-gray-light">Date:</div>
              <div class="text-gray-light">Date:</div>
              <div class="text-gray-light">District:</div>
              <br>
              <div class="text-gray-light">Refusal Code:</div>
            </div>

            <div class="col-md-4" style="text-align: left; font-size: 17px">
              <div class="text-gray-light">Prev. Regn. No. (If any)</div>
              <div class="text-gray-light">Issue by:</div>
              <div class="text-gray-light">Received by:</div>
              <div class="text-gray-light">Vehicle ID:</div>
              <div class="text-gray-light">Call non date:</div>
              <div class="text-gray-light">Refused by:</div>
              <div class="text-gray-light">Index No.</div>
            </div>

            <center class="text-bold text-center col-md-12">
              <h5>
                <strong> <u> To be filled in by the Owner </u> </strong>
              </h5>
              <h4 class="name"><strong>Section-II</strong></h4>
              <h5><strong> (Owner information) </strong></h5>
            </center>

            <div class="col-md-6" style="text-align: left; font-size: 17px">
              <div class="text-gray-light">01. Name of owner:</div>
              <div class="text-gray-light">03. Father/Husband:</div>
              <div class="text-gray-light">05. Sex:</div>
              <div class="text-gray-light">07. Owner’s Address (One only):</div>
              <div class="text-gray-light">
                08. Phone No. (If any): 01738439311
              </div>
              <div class="text-gray-light">13. Hire: NO</div>
            </div>

            <div class="col-md-6" style="text-align: left; font-size: 17px">
              <div class="text-gray-light">02. Date of birth :</div>
              <div class="text-gray-light">04. Nationality : BANGLADESHI</div>
              <div class="text-gray-light">06. Guardian’s name : NO</div>
              <br>
              <div class="text-gray-light">11. Owner type: PRIVATE</div>
              <div class="text-gray-light">14. Hire purchase: NO</div>
            </div>

            <center class="text-bold text-center col-md-12">
              <h5>
                <strong> <u> To be filled in by the Owner </u> </strong>
              </h5>
              <h4 class="name"><strong>Section III</strong></h4>
              <h5><strong> (Owner information) </strong></h5>
            </center>

            <div class="col-md-6" style="text-align: left; font-size: 17px">
              <div class="text-gray-light">14. Vehicle or trailer: VEHICLE</div>
              <div class="text-gray-light">
                14a. Class of vehicle: MOTORCYCLE
              </div>
              <div class="text-gray-light">16. Type of body: MOTORCYCLE</div>
              <div class="text-gray-light">18. Color (cabin/body):</div>
              <div class="text-gray-light">
                20. Number of cylinders: 01 CYLINDER
              </div>
              <div class="text-gray-light">22. Engine number:</div>
              <div class="text-gray-light">24. Horse power:</div>
              <div class="text-gray-light">26. Cubic capacity:</div>
              <div class="text-gray-light">28. No. of Standee:</div>
              <div class="text-gray-light">30. Unladen weight (kg)</div>
            </div>

            <div class="col-md-6" style="text-align: left; font-size: 17px">
              <div class="text-gray-light">
                15. Prev. Regn. No. (If any): NEW
              </div>
              <div class="text-gray-light">
                15a. Maker’s name: BAJAJ AUTO LTD. INDIA
              </div>
              <div class="text-gray-light">17. Maker’s Country: INDIA</div>
              <div class="text-gray-light">19. Year of manufacture:</div>
              <div class="text-gray-light">21. Chassis number:</div>
              <div class="text-gray-light">23. Fuel used: PETROL</div>
              <div class="text-gray-light">25. RPM: RPM:</div>
              <div class="text-gray-light">
                27. Seats (incl. driver):2 PERSON
              </div>
              <div class="text-gray-light">29. Wheel base:</div>
              <div class="text-gray-light">
                31. Maximum laden/train weight (kg):
              </div>
            </div>

            <center class="text-bold text-center col-md-12">
              <h4 class="name"><strong>Section IV</strong></h4>
              <h5>
                <strong>
                  (Additional information for transport vehicle)
                </strong>
              </h5>
            </center>

            <div class="col-md-6" style="text-align: left; font-size: 17px">
              <div class="text-gray-light">32. No. of types : 02 TWO</div>
              <div class="text-gray-light">34. No. of axle : 02 TWO</div>
              <br>
              <br>
              <br>
            </div>

            <div class="col-md-6" style="text-align: left; font-size: 17px">
              <div class="text-gray-light">33. Tyres size: R:</div>
              <div class="text-gray-light">35. Maximum axle weight (kg):</div>
              <div class="text-gray-light">
                a) Front axle &nbsp; (1) &nbsp; (2)
              </div>
              <div class="text-gray-light">
                b) Central axle &nbsp; (1) &nbsp; (2) &nbsp; (3)
              </div>
              <div class="text-gray-light">
                c) Rear axle &nbsp; (1) &nbsp; (2) &nbsp; (3)
              </div>
              <div class="text-gray-light">23. Fuel used: PETROL</div>
              <div class="text-gray-light">25. RPM: RPM:</div>
              <div class="text-gray-light">
                27. Seats (incl. driver):2 PERSON
              </div>
              <div class="text-gray-light">29. Wheel base:</div>
              <div class="text-gray-light">
                31. Maximum laden/train weight (kg):
              </div>
            </div>

            <div class="col-md-12" style="text-align: left; font-size: 17px">
              <div class="text-gray-light">
                36. Dimensions (mm): <br>

                &nbsp; a) Overall length &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; b) Overall width &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; c)
                Overall height
              </div>

              <div class="text-gray-light">
                37. Overhangs (%) <br>

                &nbsp; a) Front &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; b) Rear &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; c) Other
              </div>
            </div>

            <div class="col-md-12 pagebreak" style="text-align: justify; font-size: 17px;" >
              38. A copy of the drawing showing the vehicle dimension
              specifications of the body and the seating arrangements approved
              by ....................................................on.
              .............................................is attached herewith.
            </div>
          </div>
          <hr>
        </div>
      </div>
      <div></div>
      <div class="invoice overflow-auto" style="margin-top: 300px;">
        <div style="min-width: 600px">
          <div class="row">
            <div class="col-md-12 company-details text-center">
              <h4 class="name"><strong>Section-V</strong></h4>
              <br>
            </div>

            <div class="col-md-8" style="text-align: left; font-size: 17px">
              <div class="text-gray-light">
                39. Hire purchase/hypothecation information:
              </div>
              <div class="text-gray-light">
                &nbsp; The vehicle is subject to hire purchase/hypothecation
                with:
              </div>
              <div class="text-gray-light">&nbsp; a) Name:</div>
              <div class="text-gray-light">&nbsp; c) Address:</div>
            </div>

            <div class="col-md-4" style="text-align: left; font-size: 17px">
              <br>
              <br>
              <div class="text-gray-light">b) Date:</div>
            </div>

            <div class="col-md-8" style="text-align: left; font-size: 17px">
              <div class="text-gray-light">40. Insurance information:</div>
              <div class="text-gray-light">
                a) Policy no: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                &nbsp; &nbsp; b) Type of policy:
              </div>
              <div class="text-gray-light">d) Date of expiry:</div>
            </div>

            <div class="col-md-4" style="text-align: left; font-size: 17px">
              <br>
              <div class="text-gray-light">
                c) Insurer’s name &amp; address:
              </div>
            </div>

            <div class="col-md-8" style="text-align: left; font-size: 17px">
              <div class="text-gray-light">41. Joint owner information:</div>
              <div class="text-gray-light">a) Name:</div>
              <div class="text-gray-light">&nbsp; Father/Husband:</div>
            </div>

            <div class="col-md-4" style="text-align: left; font-size: 17px">
              <br>
              <div class="text-gray-light">b) Name:</div>
              <div class="text-gray-light">&nbsp; Father/Husband:</div>
            </div>

            <div class="col-md-12 company-details text-center">
              <h4 class="name"><strong>Section-VI </strong></h4>
              <h5 class="name">
                <strong> (Declaration, Certificates and documents) </strong>
              </h5>
            </div>

            <div class="col-md-12" style="text-align: justify; font-size: 17px">
              <div class="text-gray-light">42. Declaration by owner:</div>
              <div class="text-gray-light">
                &nbsp; a) I the undersigned do hereby declare that to the best
                of my knowledge and belief, the information given and the
                documents enclosed (as per list attached) are true. <br>
                &nbsp; I also declare that in case the papers/documents and
                information furnished are found to be incorrect at any later
                stage, I shall be liable for legal action.
              </div>
            </div>

            <div class="col-md-8" style="text-align: justify; font-size: 17px"></div>
            <div class="col-md-4" style="
                text-align: center;
                font-size: 17px;
                margin-top: 40px;
                border-top: 1px dotted gray;
              ">
              <div class="text-gray-light">Signature of owner</div>
              <div class="text-gray-light">Seal</div>
            </div>

            <div class="col-md-12" style="text-align: justify; font-size: 17px">
              <div class="text-gray-light">Date:</div>
              <div class="text-gray-light">Encl: List of documents</div>
              <div class="text-gray-light">
                43. Registered dealer’s certificate:
              </div>
              <div class="text-gray-light">
                &nbsp; I the undersigned do hereby certify that the vehicle in
                question has been sold by me/my firm and the ownership documents
                attached with the application for registration are true. The
                information/specifications pertaining to the vehicle are correct
                and the vehicle complies with all the requirements of the
                registration.
              </div>
            </div>

            <div class="col-md-8" style="text-align: justify; font-size: 17px"></div>
            <div class="col-md-4" style="
                text-align: center;
                font-size: 17px;
                margin-top: 40px;
                border-top: 1px dotted gray;
              ">
              <div class="text-gray-light">Signature of registered dealer</div>
              <div class="text-gray-light">Seal</div>
            </div>

            <div class="col-md-12" style="text-align: justify; font-size: 17px">
              <div class="text-gray-light">Date:</div>
              <div class="text-gray-light">Encl: List of documents</div>
              <div class="text-gray-light">
                44. Certificate by the Inspector of Motor Vehicles:
              </div>
              <div class="text-gray-light">
                Certificate that the particulars pertaining to the owner and the
                vehicle (Chassis
                No................................................ Engine
                No.........................................................)
                given in the application match with the ownership documents
                attached to this application. It is further certified that the
                vehicle complies with the registration requirements specified in
                the MV Act and the Rules and/or Regulations made there under and
                the vehicle is not mechanically defective. The necessary
                documents/papers are available as per list enclosed.
              </div>
            </div>

            <div class="col-md-4" style="text-align: left; font-size: 17px">
              <div class="text-gray-light">Date:</div>
              <div class="text-gray-light">Encl: List of documents</div>
            </div>

            <div class="col-md-4" style="text-align: justify; font-size: 17px"></div>
            <div class="col-md-4" style="
                text-align: center;
                font-size: 17px;
                margin-top: 40px;
                border-top: 1px dotted gray;
              ">
              <div class="text-gray-light">
                Signature of Inspector of Motor Vehicles
              </div>
              <div class="text-gray-light">Official Seal</div>
            </div>

            <div class="col-md-4" style="text-align: left; font-size: 17px">
              <div class="text-gray-light">45. Registration Status:</div>
              <div class="text-gray-light">
                &nbsp; Registration allowed/not allowed
              </div>
            </div>

            <div class="col-md-4" style="text-align: justify; font-size: 17px"></div>
            <div class="col-md-4" style="
                text-align: center;
                font-size: 17px;
                margin-top: 40px;
                border-top: 1px dotted gray;
              ">
              <div class="text-gray-light">
                Signature of Registering Authority
              </div>
              <div class="text-gray-light">Seal</div>
            </div>

            <div class="col-md-12" style="text-align: justify; font-size: 17px">
              <div class="text-gray-light">46. Fees and Tax Accounts:</div>
              <div class="text-gray-light">
                &nbsp; Necessary fees and taxes amounting to
                taka.............................................................................................has
                been paid to PO/Bank. vide vouchers and receipts enclosed.
              </div>
            </div>

            <div class="col-md-4" style="
                text-align: left;
                font-size: 17px;
                text-align: center;
                font-size: 17px;
                margin-top: 40px;
                border-top: 1px dotted gray;
              ">
              <div class="text-gray-light">
                &nbsp; &nbsp; Signature of owner
              </div>
              <div class="text-gray-light">
                &nbsp; &nbsp; of his representative
              </div>
            </div>

            <div class="col-md-4" style="
                text-align: justify;
                font-size: 17px;
                text-align: center;
                font-size: 17px;
              "></div>
            <div class="col-md-4" style="
                text-align: center;
                font-size: 17px;
                text-align: center;
                font-size: 17px;
                margin-top: 40px;
                border-top: 1px dotted gray;
              ">
              <div class="text-gray-light">Signature of dealing assistant</div>
            </div>

            <div class="col-md-12" style="text-align: center; font-size: 17px">
              <div class="text-gray-light">
                Counter signature by the registering authority.
              </div>
            </div>
          </div>
        </div>
      </div>
      <div></div>
      <div class="invoice overflow-auto" style="margin-top: 300px;">>
        <div style="min-width: 600px">
          <div class="row">

              <div class="col-md-2"></div>
              <div class="col-md-8 company-details text-center">
                <h4 class="name"><strong>OWNER’S PARTICULARS/SPECIMEN SIGNATURE</strong></h4>
              </div>
              <div class="col-md-2" style="border:2px solid #3989c6; height: 110px; width: 50px; text-align: center; font-size: 18px;  ">
                <p>Stamp Size Color Pic</p>
              </div>
              <div class="col-md-12" style="font-size: 25px;">
                <div class="text-gray-light text-left">1. NAME        : &nbsp;</div>
              </div>
              <div class="col-md-12" style="font-size: 25px;">
                <div class="text-gray-light text-left">2. FATHER/ HUSBAND : &nbsp;</div>
              </div>
              <div class="col-md-12" style="font-size: 25px;">
                <div class="text-gray-light text-left">3. ADDRESS     : &nbsp;</div>
              </div>
              <div class="col-md-12" style="font-size: 25px;">
                <div class="text-gray-light text-left">4. SEX       :      MALE &nbsp;</div>
              </div>
              <div class="col-md-12" style="font-size: 25px;">
                <div class="text-gray-light text-left">4. NATIONALITY        :      BANGLADESHI   &nbsp;</div>
              </div>
              <div class="col-md-12" style="font-size: 25px;">
                <div class="text-gray-light text-left">4. DATE OF BIRTH        :      &nbsp;</div>
              </div>
              <div class="col-md-12" style="font-size: 25px;">
                <div class="text-gray-light text-left">4. GUARDIAN’S NAME : NO        &nbsp;</div>
              </div>
              <div class="col-md-12" style="font-size: 25px;">
                <div class="text-gray-light text-left">4. CHASSIS NO :          &nbsp;</div>
              </div>
              <div class="col-md-12" style="font-size: 25px;">
                <div class="text-gray-light text-left">4. ENGINE NO :      &nbsp;</div>
              </div>
              <div class="col-md-12" style="font-size: 25px;">
                <div class="text-gray-light text-left">4. YEAR OF MFG :       &nbsp;</div>
              </div>
              <div class="col-md-12" style="font-size: 25px;">
                <div class="text-gray-light text-left">4. PREV. REGN. NO. (IF ANY) : NEW      &nbsp;</div>
              </div>
              <div class="col-md-12" style="font-size: 25px;">
                <div class="text-gray-light text-left">4. P.O./BANK:        &nbsp;</div>
              </div>
              <div class="col-md-12" style="font-size: 25px;">
                <div class="text-gray-light text-left">   <h5> &nbsp; &nbsp; &nbsp; <u> SPECIMEN SIGNATURE  </u> </h5></div>
              </div>

                <div class="col-md-1"> </div>

                1. &nbsp; <div class="col-md-4" style="border:2px solid #3989c6; height: 110px; width: 50px; text-align: center; "></div>

                <div class="col-md-2"> </div>

                2. &nbsp; <div class="col-md-4" style="border:2px solid #3989c6; height: 110px; width: 50px; text-align: center;  ">
                </div>
                <div class="col-md-1"> </div>

                3. &nbsp; <div class="col-md-4" style="border:2px solid #3989c6; height: 110px; width: 50px; text-align: center; "></div>

                <div class="col-md-2"> </div>

                4. &nbsp; <div class="col-md-4" style="border:2px solid #3989c6; height: 110px; width: 50px; text-align: center;  ">
                </div>
                <div class="col-md-1"> </div>




            </div>
          </div>
        </div>
      </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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
