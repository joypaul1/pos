<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<title>PDF Report</title>
<style type="text/css">

table {
  border-collapse: collapse;
}

h2 h3{
  margin:0;
  padding:0;
}
.table {
  width: 100%;
  margin-bottom: 1rem;
  background-color: transparent;
}

.table th,
.table td {
  padding: 0.75rem;
  vertical-align: top;
  border-top: 1px solid #dee2e6;
}

.table thead th {
  vertical-align: bottom;
  border-bottom: 2px solid #dee2e6;
}

.table tbody + tbody {
  border-top: 2px solid #dee2e6;
}

.table .table {
  background-color: #fff;
}

.table-bordered {
  border: 1px solid #dee2e6;
}

.table-bordered th,
.table-bordered td {
  border: 1px solid #dee2e6;
}

.table-bordered thead th,
.table-bordered thead td {
  border-bottom-width: 2px;
}

.text-center{
  text-align: center;
}
.text-right{
  text-align: right;
}
table tr td{
  padding: 5px;
}

.table-bordered thead th, .table-bordered td, .table-bordered th{
   border: 1px solid black !important;
}

.table-bordered thead th{
  background-color:  #cacaca;
}
.borderNone{
    border: none !important
}
.table-header {
    background: green !important;
    color: white;
}
@media print {
        body {
            -webkit-print-color-adjust: exact;
        }
        .table-header {
            background: green !important;
            color: white;
        }
        .borderNone{
            border: none !important
        }
        .hidden-print {
            display: none !important;
        }
    }

</style>
<body>
  <div class="container" >
    <div class="row">
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
      <table style="width: 100%">
        <tbody>
          <tr>
            <td style="width: 25%" class="text-left">Memo No: # {{$purchase->purchase_no}}</td>
            <td class="text-center" style="width: 50%">
              <img src="{{(!empty($owner->image)) ? url('public/backend/user_images/'.$owner->image) : url('public/backend/images/noimage.png')}}" style="height: 60px;width: 80px;">
              <h3 style="font-weight: bold"><strong>{{$owner->name}}</strong></h3>
              <h5><strong>{{$owner->address}}</strong></h5>
              <h4><strong>{{$owner->mobile}}</strong></h4>
            </td>
            <td class="text-center" style="width: 25%">Date: {{date('d-m-Y',strtotime($purchase->date))}}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="row">
      <div class="col col-sm-12 text-center">
        <h4 style="font-weight: bold">
          <u>
            PURCHASE
          </u>
        </h4>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        @php
          $purchase_payment = App\Model\PurchasePayment::where('purchase_id',$purchase->id)->first();
        @endphp
        <table class="table">
          <tbody>
            <tr>
              <td class="borderNone" width="100%">Supplier Name : {{$purchase_payment['supplier']['name']}}</td>
            </tr>
            <tr>
              <td class="borderNone" width="100%">Mobile No : {{$purchase_payment['supplier']['mobile']}}</td>
            </tr>
            <tr>
              <td class="borderNone" width="100%">Address : {{$purchase_payment['supplier']['address']}}</td>
            </tr>
            <tr>
              <td class="borderNone" width="100%">Description : {{$purchase->description}}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-sm-12">
        <table class="table table-sm table-bordered">
          <thead>
            <tr>

                <th class="text-center table-header" >SL.</th>
                <th class="text-center table-header" >Product Name</th>
                <th class="text-center table-header" >Sell Price</th>
                <th class="text-center table-header" >Free Qty</th>
                <th class="text-center table-header" >Quantity</th>
                <th class="text-center table-header" >Unit Price</th>
                <th class="text-center table-header" >Amount</th>

            </tr>
          </thead>
          <tbody>

              @php
                $product_sale_sum = 0;
              @endphp
              @foreach($purchase['purchase_details'] as $key => $details)
              <tr>
                <td class="text-center" >{{$key+1}}</td>
                <td class="text-center" >{{@$details['product']['name']}}</td>
                <td class="text-center" >{{$details->selling_price}} TK</td>
                <td class="text-center" >{{$details->free_quantity}}</td>
                <td class="text-center" >{{$details->buying_qty}}</td>
                <td class="text-center" >{{$details->unit_price}} TK</td>
                <td class="text-center" >{{$details->buying_price}} TK</td>
                @php
                  $product_sale_sum += $details->buying_price;
                @endphp
              </tr>
              @endforeach
              <tr>
                <td class="text-right" colspan="6">Product Total Price</td>
                <td>{{$product_sale_sum}} TK</td>
              </tr>
            <tr>
                <th class="text-center" colspan="3">Total Amount</th>
                <th class="text-center" colspan="3">Paid Amount</th>
                <th class="text-center">Due Amount</th>
            </tr>

            <tr>
              <td class="text-center"  colspan="3">{{$purchase_payment->total_amount}} TK</td>
              <td class="text-center"  colspan="3">{{$purchase_payment->paid_amount}} TK</td>
              <td class="text-center" >{{$purchase_payment->due_amount}} TK</td>
            </tr>
            <tr>
              <td colspan="7" class="text-center">Payment Summary</td>
            </tr>
            <tr>
              <td class="text-center">SL.</td>
              <td class="text-center" colspan="2">Date</td>
              <td class="text-center">Bank Name</td>
              <td class="text-center">Cheque No</td>
              <td class="text-center">Created By</td>
              <td class="text-center" >Amount</td>
            </tr>
            @php
              $total_paid_sum = 0;
            @endphp
            @foreach($purchase['purchase_payment_details'] as $key2 => $payment_details)
            <tr>
              <td class="text-center" >{{$key2+1}}</td>
              <td class="text-center"  colspan="2">{{date('d-m-Y',strtotime($payment_details->date))}}</td>
              <td class="text-center" >{{$payment_details->bank_name}}</td>
              <td class="text-center" >{{$payment_details->cheque_no}}</td>
              <td class="text-center" >{{@$payment_details['user']['name']}}</td>
              <td class="text-right" >{{$payment_details->current_paid_amount}}</td>
            </tr>
            @php
              $total_paid_sum += $payment_details->current_paid_amount;
            @endphp
            @endforeach
            <tr>
              <td class="text-right" colspan="5">Total Paid Amount</td>
              <td  class="text-right" colspan="2">{{$total_paid_sum}}</td>
            </tr>

          </tbody>
        </table>
          @php
            $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
          @endphp
          <i style="font-size: 11px; float: right;">Printing Date: {{$dt->format('F j, Y, g:i a')}} </i>
      </div><br/><br/>
      <div class="col-md-12">
        <hr style="margin-bottom: 0px;width: 20%;text-align: right;">
        <table border="0" width="100%">
          <tbody>
            <tr>
              <td style="width: 60%; ">
              </td>
              <td style="width: 20%"></td>
              <td style="width: 21%; text-align: center;">
                <p style="text-align: center;">{{@$purchase['user']['name']}}</p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $("#printInvoice").click(function () {
    //   Popup($(".invoice")[0].outerHTML);
    //   function Popup(data) {
    //     window.print();
    //     return true;
    //   }
    window.print();
    });
    $(document).ready(function(){
        // alert(2343);
          window.print();
    })
  </script>


</html>
