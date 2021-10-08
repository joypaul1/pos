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
            <td style="width: 25%" class="text-center"></td>
            <td class="text-center" style="width: 50%">
              <img src="{{(!empty($owner->image)) ? url('public/backend/user_images/'.$owner->image) : url('public/backend/images/noimage.png')}}" style="height: 60px;width: 80px;">
              <h3 style="font-weight: bold"><strong>{{$owner->name}}</strong></h3>
              <h5><strong>{{$owner->address}}</strong></h5>
              <h4><strong>{{$owner->mobile}}</strong></h4>
            </td>
            <td class="text-center" style="width: 25%"></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="row">
      <div class="col col-sm-12 text-center">
        <h4 style="font-weight: bold">
          <u>
            PROFIT ({{$start_date}} - {{$end_date}})
          </u>
        </h4>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <table class="table table-sm table-bordered">
          <thead>
            <tr>
              <th>Sales</th>
              <th>Purchase</th>
              <th>Expanse</th>
              <th>Total Cost</th>
              <th>Profit</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{$sales}} TK</td>
              <td>{{$purchase}} TK</td>
              <td>{{$expanse}} TK</td>
              <td>{{$cost}} TK</td>
              <td>{{$profit}} TK</td>
            </tr>
            <tr>
              <td colspan="5" class="text-center">Sales List</td>
            </tr>
            <tr>
              <td>SL.</td>
              <td>Invoice No</td>
              <td>Date</td>
              <td>Amount</td>
            </tr>
            @php
              $total_sales_sum = 0;
            @endphp
            @foreach($allInvoice as $key => $value)
            <tr>
              <td>{{$key+1}}</td>
              <td># {{@$value['invoice_no']}}</td>
              <td>{{date('d-m-Y',strtotime($value->date))}}</td>
              <td>{{$value->grand_total}}</td>
            </tr>
            @php
              $total_sales_sum += $value->grand_total;
            @endphp
            @endforeach
            <tr>
              <td class="text-right" colspan="4">Total</td>
              <td>{{$total_sales_sum}}</td>
            </tr>
            <tr>
              <td colspan="5" class="text-center">Purchase List</td>
            </tr>
            <tr>
              <td>SL.</td>
              <td>purchase No</td>
              <td>Date</td>
              <td>Amount</td>

            </tr>
            @php
              $total_purchase_sum = 0;
            @endphp
            @foreach($allPurchase as $key => $value)
            <tr>
              <td>{{$key+1}}</td>
              <td># {{@$value['purchase']['purchase_no']}}</td>
              <td>{{date('d-m-Y',strtotime($value->date))}}</td>
              <td>{{$value->current_paid_amount}}</td>
            </tr>
            @php
              $total_purchase_sum += $value->current_paid_amount;
            @endphp
            @endforeach
            <tr>
              <td class="text-right" colspan="4">Total</td>
              <td>{{$total_purchase_sum}}</td>
            </tr>
            <tr>
              <td colspan="5" class="text-center">Expanse List</td>
            </tr>
            <tr>
              <td>SL.</td>
              <td>Expanse Type</td>
              <td>Date</td>
              <td>Amount</td>
              <td>Description</td>
            </tr>
            @php
              $total_expanse_sum = 0;
            @endphp
            @foreach($allExpanse as $key => $value)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{@$value['expanse_type']['name']}}</td>
              <td>{{date('d-m-Y',strtotime($value->date))}}</td>
              <td>{{$value->amount}}</td>
              <td>{{$value->details}}</td>
            </tr>
            @php
              $total_expanse_sum += $value->amount;
            @endphp
            @endforeach
            <tr>
              <td class="text-right" colspan="4">Total</td>
              <td>{{$total_expanse_sum}}</td>
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
                <p style="text-align: center;">Authority Signature</p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
