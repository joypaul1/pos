
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
      padding: 15px;
      /* background: #eee; */
      border-bottom: 1px solid #fff;
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
      border: none;
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
    .bg-voilet {
      background-color: #0e6a91;
    }
    .bd-dotted {
      border-bottom: 2px dotted gray !important;
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
                <address>Address : Address will be here..</address>
              </div>
              <div class="col-md-3">
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
                <div class="text-gray-light">To: Registation Authority</div>
              </div>
              <div class="col invoice-details">
                <!-- <h1 class="invoice-id">INVOICE 3-2-1</h1> -->
                <!-- <div class="date">Date of Invoice: 01/10/2018</div> -->
                <div class="date">
                  Date:
                  <span style="border-bottom: 2px dotted">30/10/2018</span>
                </div>
              </div>
              <!-- <div class="col-md-12"> -->

              <!-- </div> -->
            </div>
            <center class="text-bold text-center">
              <h4>To Whome It May Concern</h4>
            </center>
            <p style="margin: 0 !important">
              THis is to certify that we have solid new vhicle to :
            </p>
            <table border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td class="bd-dotted"></td>
                </tr>
                <tr>
                  <td class="bd-dotted"></td>
                </tr>
              </tbody>
            </table>
            <p
              class=""
              style="
                color: red !important;
                -webkit-print-color-adjust: exact;
                border-bottom: 2px dotted red;
                width: 17%;
                font-weight: 600;
              "
              s
            >
              On the Following Particulars :
            </p>
            <table border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td
                    class="text-left"
                    style="
                      border-bottom: 2px dotted gray;
                      padding-left: 0;
                      padding-bottom: 5px;
                    "
                  >

                    01. Model/Make Of Vehicle : {{ $data->class_Of_vehicle??"-" }}
                  </td>
                </tr>
                <tr>
                  <td
                    class="text-left"
                    style="
                      border-bottom: 2px dotted gray;
                      padding-left: 0;
                      padding-bottom: 5px;
                    "
                  >
                    02. Class Of Vehicle : {{ $data->model_Of_vehicle??"-" }}
                  </td>
                </tr>
                <tr>
                  <td
                    class="text-left"
                    style="
                      border-bottom: 2px dotted gray;
                      padding-left: 0;
                      padding-bottom: 5px;
                    "
                  >
                    03. Chasiss No : {{ $data->chasiss_no??"-" }}
                  </td>
                </tr>
                <tr>
                  <td
                    class="text-left"
                    style="
                      border-bottom: 2px dotted gray;
                      padding-left: 0;
                      padding-bottom: 5px;
                    "
                  >
                    04. Engine No : {{ $data->engine_no??"-" }}
                  </td>
                </tr>
                <tr>
                  <td
                    class="text-left"
                    style="
                      border-bottom: 2px dotted gray;
                      padding-left: 0;
                      padding-bottom: 5px;
                    "
                  >
                    05. key No : {{ $data->key_no??"-" }}
                  </td>
                </tr>
                <tr>
                  <td
                    class="text-left"
                    style="
                      border-bottom: 2px dotted gray;
                      padding-left: 0;
                      padding-bottom: 5px;
                    "
                  >
                    06. None Of Cylineder With CC : {{ $data->none_of_cylineder_with_cc??"-" }}
                  </td>
                </tr>
                <tr>
                  <td
                    class="text-left"
                    style="
                      border-bottom: 2px dotted gray;
                      padding-left: 0;
                      padding-bottom: 5px;
                    "
                  >
                    07. Colour Of Vehicle: {{ $data->colour??"-" }}
                  </td>
                </tr>
                <tr>
                  <td
                    class="text-left"
                    style="
                      border-bottom: 2px dotted gray;
                      padding-left: 0;
                      padding-bottom: 5px;
                    "
                  >
                    08. Size Of type: {{ $data->size??"-" }}
                  </td>
                </tr>
                <tr>
                  <td
                    class="text-left"
                    style="
                      border-bottom: 2px dotted gray;
                      padding-left: 0;
                      padding-bottom: 5px;
                    "
                  >
                    09. Year Of Manufacture/Assembel : {{ $data->year_of_manufacture??"-" }}
                  </td>
                </tr>
                <tr>
                  <td
                    class="text-left"
                    style="
                      border-bottom: 2px dotted gray;
                      padding-left: 0;
                      padding-bottom: 5px;
                    "
                  >
                    10. Hourse Power : {{ $data->hourse_power??"-" }}
                  </td>
                </tr>
                <tr>
                  <td
                    class="text-left"
                    style="
                      border-bottom: 2px dotted gray;
                      padding-left: 0;
                      padding-bottom: 5px;
                    "
                  >
                    11. Laden Weight : {{ $data->laden_weight??"-" }}
                  </td>
                </tr>
                <tr>
                  <td
                    class="text-left"
                    style="
                      border-bottom: 2px dotted gray;
                      padding-left: 0;
                      padding-bottom: 5px;
                    "
                  >
                    12. Wheel Base : {{ $data->wheel_base??"-" }}
                  </td>
                </tr>
                <tr>
                  <td
                    class="text-left"
                    style="
                      border-bottom: 2px dotted gray;
                      padding-left: 0;
                      padding-bottom: 5px;
                    "
                  >
                    13. Seating Capacity : {{ $data->seating_capacity??"-" }}
                  </td>
                </tr>
                <tr>
                  <td
                    class="text-left"
                    style="
                      border-bottom: 2px dotted gray;
                      padding-left: 0;
                      padding-bottom: 5px;
                    "
                  >
                    14. Maker's Name : {{ $data->makers_Name??"-" }}
                  </td>
                </tr>
                <tr>
                  <td
                    class="text-left"
                    style="
                      border-bottom: 2px dotted gray;
                      padding-left: 0;
                      padding-bottom: 5px;
                    "
                  >
                    15. Unit Price :{{ $data->unit_price??"-" }}
                  </td>
                </tr>
              </tbody>
            </table>
          </main>
          <footer class="row">
            <p class="col-md-12 text-center text-bold">For company name</p>
            <div class="col-md-6 text-left text-bold">
              <span style="border-top: 1px dotted red">
                Owner's Signature
              </span>
            </div>
            <div class="col-md-6 text-right text-bold">
              <span style="border-top: 1px dotted red">Sales Department</span>
            </div>
          </footer>
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
    </script>
  </body>
</html>
