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


</style>
<body>
  <div class="container">
    <div class="row">
      <table style="width: 100%">
        <tbody>
          <tr>
            <td style="width: 25%" class="text-center">Memo No: # {{$invoice->invoice_no}}</td>
            <td class="text-center" style="width: 50%">
              <img src="{{(!empty($owner->image)) ? url('public/backend/user_images/'.$owner->image) : url('public/backend/images/noimage.png')}}" style="height: 60px;width: 80px;">
              <h3 style="font-weight: bold"><strong>{{$owner->name}}</strong></h3>
              <h5><strong>{{$owner->address}}</strong></h5>
              <h4><strong>{{$owner->mobile}}</strong></h4>
            </td>
            <td class="text-center" style="width: 25%">Date: {{date('d-m-Y',strtotime($invoice->date))}}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="row">
      <div class="col col-sm-12 text-center">
        <h4 style="font-weight: bold">
          <u>
            INVOICE
          </u>
        </h4>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        @php
          $invoice_payment = App\Model\InvoicePayment::where('invoice_id',$invoice->id)->first();
        @endphp
        <table class="table">
          <tbody>
            <tr>
              <td width="100%">Customer Name : {{@$invoice['invoice_payment']['customer']['name']}}</td>
            </tr>
            <tr>
              <td width="100%">Mobile No : {{@$invoice['invoice_payment']['customer']['mobile']}}</td>
            </tr>
            <tr>
              <td width="100%">Address : {{@$invoice['invoice_payment']['customer']['address']}}</td>
            </tr>
            <tr>
              <td width="100%">Description : {{@$invoice->description}}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-sm-12">
        <table class="table table-sm table-bordered">
          <thead>
            <tr>
              <th colspan="3">Total Amount</th>
              <th colspan="4">Paid Amount</th>
              <th>Due Amount</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="3">{{$invoice_payment->total_amount}} TK</td>
              <td colspan="4">{{$invoice_payment->paid_amount}} TK</td>
              <td>{{$invoice_payment->due_amount}} TK</td>
            </tr>
            <tr>
              <td colspan="8" class="text-center">Payment Summary</td>
            </tr>
            <tr>
              <td>SL.</td>
              <td colspan="2">Date</td>
              <td>Bank Name</td>
              <td>Cheque No</td>
              <td colspan="2">Amount</td>
              <td>Created By</td>
            </tr>
            @php
              $total_paid_sum = 0;
            @endphp
            @foreach($invoice['invoice_payment_details'] as $key2 => $payment_details)
            <tr>
              <td>{{$key2+1}}</td>
              <td colspan="2">{{date('d-m-Y',strtotime($payment_details->date))}}</td>
              <td>{{$payment_details->bank_name}}</td>
              <td>{{$payment_details->cheque_no}}</td>
              <td colspan="2">{{$payment_details->current_paid_amount}}</td>
              <td>{{@$payment_details['user']['name']}}</td>
            </tr>
            @php
              $total_paid_sum += $payment_details->current_paid_amount;
            @endphp
            @endforeach
            <tr>
              <td class="text-right" colspan="5">Total Paid Amount</td>
              <td colspan="3">{{$total_paid_sum}}</td>
            </tr>
            <tr>
              <td colspan="8" class="text-center">Product List</td>
            </tr>
            <tr>
              <td>SL.</td>
              <td>Product Name</td>
              <td>Serial No</td>
              <td>Free Qty</td>
              <td>Warranty</td>
              <td>Quantity</td>
              <td>Unit Price</td>
              <td>Amount</td>
            </tr>
            @php
              $product_sale_sum = 0;
            @endphp
            @foreach($invoice['invoice_details'] as $key => $details)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{@$details['product']['name']}}</td>
              <td>{{$details->serial_no}}</td>
              <td>{{$details->free_selling_qty}}</td>
              <td>{{$details->warranty}}</td>
              <td>{{$details->selling_qty}}</td>
              <td>{{$details->selling_price}} TK</td>
              @php
                $total_amount = $details->selling_qty*$details->selling_price;
              @endphp
              <td>{{$total_amount}}</td>
              @php
                $product_sale_sum += $total_amount;
              @endphp
            </tr>
            @endforeach
            <tr>
              <td class="text-right" colspan="7">Product Total Price</td>
              <td>{{$product_sale_sum}} TK</td>
            </tr>
          </tbody>
        </table>
          @php
            $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
          @endphp
          <i style="font-size: 11px; float: right;">Printing Date: {{$dt->format('F j, Y, g:i a')}} </i>
      </div><br/><br/>
      <div class="col-md-12">
        <hr style="margin-bottom: 0px;">
        <table border="0" width="100%">
          <tbody>
            <tr>
              <td style="width: 40%; ">
                <p style="text-align: center;margin-left: : 20px;">Customer Signature</p> 
              </td>
              <td style="width: 20%"></td>
              <td style="width: 40%; text-align: center;">
                <p style="text-align: center;">{{@$invoice['user']['name']}}</p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>
  




</body>
</html>
