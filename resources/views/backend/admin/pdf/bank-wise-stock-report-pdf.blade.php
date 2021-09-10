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
            STOCK REPORT ({{$deposits['0']['bank']['name']}})
          </u>
        </h4>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        Bank Deposit List
        <table class="table table-bordered table-striped dt-responsive nowrap" style="width: 100%">
            <thead>
              <tr>
                <th>Sl.</th>
                <th>Date</th>
                <th>Description</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
              @php
                $total_deposit = 0;
              @endphp
              @foreach($deposits as $key => $deposit)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{date('d-m-Y',strtotime($deposit->date))}}</td>
                <td>{{$deposit->description}}</td>
                <td>{{$deposit->amount}} TK</td>
                @php
                $total_deposit += $deposit->amount;
                @endphp
              </tr>
              @endforeach
              <tr>
                <td class="text-right" colspan="3"><strong>Grand Total</strong></td>
                <td><strong>{{$total_deposit}} TK</strong></td>
              </tr>
            </tbody>
        </table>
        Bank Deposit Withdraw List
        <table class="table table-bordered table-striped dt-responsive nowrap" style="width: 100%">
            <thead>
              <tr>
                <th>Sl.</th>
                <th>Date</th>
                <th>Description</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
              @php
                $total_withdraw = 0;
              @endphp
              @foreach($withdraws as $key => $withdraw)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{date('d-m-Y',strtotime($withdraw->date))}}</td>
                <td>{{$withdraw->description}}</td>
                <td>{{$withdraw->amount}} TK</td>
                @php
                $total_withdraw += $withdraw->amount;
                @endphp
              </tr>
              @endforeach
              <tr>
                <td class="text-right" colspan="3"><strong>Grand Total</strong></td>
                <td><strong>{{$total_withdraw}} TK</strong></td>
              </tr>
            </tbody>
        </table>
        <table class="table table-bordered table-striped dt-responsive nowrap" style="width: 100%">
          <tbody>
            <tr>
              <td class="text-right"><p style="font-size: 20px; font-weight: bold;">Current Balance</p></td>
              <td><p style="font-size: 20px; font-weight: bold;">{{$total_deposit-$total_withdraw}} TK</p></td>
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
                <p style="text-align: center;">Owner Signature</p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <h6>powered by Amir It Soft </h6>
  </div>
</body>
</html>
