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
            <td style="width: 25%"></td>
            <td class="text-center" style="width: 50%">
              <img src="{{(!empty($owner->image)) ? url('public/backend/user_images/'.$owner->image) : url('public/backend/images/noimage.png')}}" style="height: 60px;width: 80px;">
              <h3 style="font-weight: bold"><strong>{{$owner->name}}</strong></h3>
              <h5><strong>{{$owner->address}}</strong></h5>
              <h4><strong>{{$owner->mobile}}</strong></h4>
            </td>
            <td style="width: 25%"></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="row">
      <div class="col col-sm-12 text-center">
        <h4 style="font-weight: bold"><u>SUPPLIER PAYMENT SUMMARY</u></h4>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table" style="padding-top: -15px;">
          <tbody>
            <tr>
              <td  width="100%">Supplier Name : {{$supplier_info->name}}</td>
            </tr>
            <tr>
              <td width="100%"> Mobile No : {{$supplier_info->mobile}}</td>
            </tr>
            <tr>
              <td width="100%">Address : {{$supplier_info->address}}</td>
            </tr>
          </tbody>
        </table>
      </div><br/>
      <div class="col-sm-12">
        <table class="table table-sm table-bordered">
          <thead>
            <tr>
              <th>Total Amount</th>
              <th>Paid Amount</th>
              <th>Due Amount</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{$supplier_info->total_amount}}</td>
              <td>{{$supplier_info->payment}}</td>
              <td>{{$supplier_info->due}}</td>
            </tr>
            <tr>
              <td colspan="3" class="text-center">Payment Summary</td>
            </tr>
            @php
              $product_sale_sum = 0;
            @endphp
            @foreach($puchase_details as $key => $details)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{date('d-m-Y',strtotime($details->date))}}</td>
              <td>{{$details->current_paid_amount}} TK</td>
              @php
                $product_sale_sum += $details->current_paid_amount;
              @endphp
            </tr>
            @endforeach
            <tr>
              <td colspan="2" class="text-right">Grand Total</td>
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
        <hr style="margin-bottom: 0px;width: 20%;text-align: right;">
        <table border="0" width="100%">
          <tbody>
            <tr>
              <td style="width: 60%; ">
              </td>
              <td style="width: 20%"></td>
              <td style="width: 21%; text-align: center;">
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
