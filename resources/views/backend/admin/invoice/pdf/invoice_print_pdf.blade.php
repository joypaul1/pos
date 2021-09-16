
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>{{ optional($invoice->customer)->name.'-'.date('m-d-Y') ?? date('m-d-Y') }}</title>
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
      padding: 10px;
      /* background: #eee; */
      border: 1px solid #3782bc;
    }

    .invoice table th {
      white-space: nowrap;
      /* font-weight: 400; */
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
      /* color: #fff; */
      /* font-size: 1.6em; */
      /* background: #3989c6; */
    }

    .invoice table .unit {
      /* background: #ddd; */
    }

    .invoice table .total {
      /* background: #3989c6; */
      /* color: #fff; */
    }

    .invoice table tbody tr:last-child td {
      /* border: none; */
    }

    .invoice table tfoot td {
      background: 0 0;
      /* border-bottom: none; */
      white-space: nowrap;
      text-align: right;
      /* padding: 10px 20px; */
      font-size: 1.2em;
      /* border-top: 1px solid #aaa; */
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
      /* border: none; */
    }

    .invoice footer {
      width: 100%;
      text-align: center;
      color: #777;
      border-bottom: 1px solid #aaa;
      padding: 8px 0;
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
      body {
        -webkit-print-color-adjust: exact;
      }
      .invoice {
        font-size: 11px !important;
        overflow: hidden !important;
      }
      .bg-voilet {
        background-color: #0e6a91 !important;
        -webkit-print-color-adjust: exact;
      }

      .invoice footer {
        position: absolute;
        bottom: 10px;
        /* page-break-after: always; */
      }

      .invoice > div:last-child {
        page-break-before: always;
      }
      .hidden-print {
        display: none !important;
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
              <div class="col-md-3">
                <a target="_blank" href="https://lobianijs.com">
                  <img
                    width="300px"
                    src="http://lobianijs.com/lobiadmin/version/1.0/ajax/img/logo/lobiadmin-logo-text-64.png"
                    data-holder-rendered="true"
                  />
                </a>
              </div>
              <div class="col-md-6 company-details text-center">
                <h2 class="name"><strong>Company Name</strong></h2>
                <h4 class="name"><strong>Delar : Company Name</strong></h4>
                <address>Address : {{ optional($invoice->customer)->address??' ' }}</address>
              </div>
              <div class="col-md-3" style="border:2px solid #3989c6">
                <p>Buyer's</p>
              </div>
            </div>
          </header>
          <main>
            <div class="row contacts">
              <div class="col-md-1s">
                <div class="text-gray-light text-left">L/C No : &nbsp;</div>
              </div>
              <div
                class="col-md-3"
                style="border-bottom: 2px dotted; width: 100%"
              ></div>
              <div class="col-md-2">
                <div class="text-gray-light text-right">Customer Name :</div>
              </div>
              <div
                class="col-md-2"
                style="border-bottom: 2px dotted; width: 100%"
              >{{ optional($invoice->customer)->name??' ' }}</div>
              <div class="col-md-2">
                <div class="text-gray-light text-right">Sales Invoice :</div>
              </div>
              <div
                class="col-md-2"
                style="border-bottom: 2px dotted; width: 100%"
              ># {{ $invoice->invoice_no??'' }}</div>
            </div>

            <div class="row contacts">
              <div class="col-md-2s">
                <div class="text-gray-light text-left">B/E Name :  &nbsp;</div>
              </div>
              <div
                class="col-md-2"
                style="border-bottom: 2px dotted; width: 100%"
              > # </div>
              {{-- <div class="col-md-2">
                <div class="text-gray-light text-left">B/E Name :</div>
              </div>
              <div
                class="col-md-2"
                style="border-bottom: 2px dotted; width: 100%"
              ></div> --}}
              <div class="col-md-2">
                <div class="text-gray-light text-right">Date: </div>
              </div>
              <div
                class="col-md-2"
                style="border-bottom: 2px dotted; width: 100%"
              >{{ $invoice->date??''  }}</div>
            </div>

            <table border="0" cellspacing="0" cellpadding="0">
              <thead>

                <tr>
                  <th class="text-center table-header" style="width: 1%">
                    Sl NO.
                  </th>
                  <th class="text-center table-header" style="width: 20%">
                    Chassis No.
                  </th>
                  <th class="text-center table-header" style="width: 15%">
                    Engine No.
                  </th>
                  <th class="text-center table-header" style="width: 10%">
                    Key No.
                  </th>
                  <th class="text-center table-header" style="width: 5%">
                    Color
                  </th>

                  <th class="text-center table-header" style="width: 20%">
                    Size
                  </th>
                  <th class="text-center table-header">Qnty</th>
                  <th class="text-center table-header">Unit Price</th>
                  <th class="text-center table-header" style="width: 20%">
                    Amount
                  </th>
                </tr>
              </thead>
              <tbody>
                @forelse ($invoice->invoice_details as $key=>$item)
                    {{-- @dd($item); --}}
                    <tr style="" aria-rowspan="">
                        <td class="no">{{ $key+1 }}</td>
                        <td class="text-left">{{ optional($item->product)->chasiss_no??'-' }}</td>
                        <td class="unit">{{ optional($item->product)->engine_no?? '-'}}</td>
                        <td class="total">{{ optional($item->product)->key_no??'-' }}</td>
                        <td class="total">{{ optional($item->product)->colour??'-' }}</td>
                        <td class="total">{{ optional($item->product)->size?? '-' }}</td>
                        <td class="total">{{ $item->selling_qty ??'-' }}</td>
                        <td class="total">{{ $item->selling_price??'-' }}</td>
                        <td class="total">{{ $item->total_price??'-' }}</td>
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
                  <td class="text-left"
                    style="border-left: 0; border-bottom: 2px dotted gray"
                    colspan="6"
                  > {{ numberTowords($invoice->total_amount??'0' ) }} ONLY. </td>

                  <td
                    class="text-center"
                    style="font-size: 16px; font-weight: 600"
                  >
                    Total Amount
                  </td>
                  <td class="text-right">{{ ($invoice->total_amount??'0' ) }}</td>
                </tr>
                <tr>
                  <td
                    style="border-top: 0; border-bottom: 2px dotted gray"
                    colspan="7"></td>
                  <td
                    class="text-center"
                    style="font-size: 16px; font-weight: 600">
                    Interest Amount
                  </td>

                  <td class="text-right">{{ ($invoice->intertest_amount??'0' ) }}</td>
                </tr>
                <tr>

                    <td style="border-top: 0;border-bottom:0" colspan="7"></td>
                    <td
                      class="text-center"
                      style="font-size: 16px; font-weight: 600"
                    >
                      Grand Amount
                    </td>
                    <td class="text-right">{{ ($invoice->grand_total??'0' ) }}</td>
                  </tr>
                <tr>
                  <td style="border-right: 0; border-top: 0;border-bottom:0" colspan="7"></td>

                  <td
                    class="text-center"
                    style="font-size: 16px; font-weight: 600"
                  >
                    Paid Amount
                  </td>
                  <td class="text-right">{{ ($invoice->paid_amount??'0' ) }}</td>
                </tr>
                <tr>
                  <td style="border-right: 0; border-top: 0" colspan="4"></td>
                  <td style="border-left: 0; border-top: 0" colspan="3"></td>
                  <td
                    class="text-center"
                    style="font-size: 16px; font-weight: 600"
                  >
                    Due Amount
                  </td>
                  <td class="text-right">{{ ($invoice->due_amount??'0' ) }}</td>
                </tr>

                <tr>
                  <td colspan="7" class="text-left">Payment Reference :</td>
                  <td colspan="2" style="border-top:0 ;border-bottom: 0;"> </td>
                </tr>
                <tr>
                  <td colspan="4" class="text-left">M.R. No :</td>
                  <td colspan="3" class="text-left">Dated : {{ date('d-m-Y') }}</td>
                  <td colspan="2" style="border-top:0 ;border-bottom: 0;"> </td>
                </tr>
                <tr>
                  <td colspan="7" class="text-left">For Taka :</td>
                  <td colspan="2" style="border-top:0 ;border-bottom: 0;">
                   </td>
                </tr>

                <tr>
                  <td class="text-left" colspan="1" style="border-right: 0">In Cash/ by :</td>
                  <td
                    colspan="6"
                    style="border-left: 0;"
                    {{-- {{ $invoice->updatedUser->name??' ' }} --}}
                    ></td>
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
      $(document).ready(function(){
            // window.print();
      })
    </script>
  </body>
</html>
