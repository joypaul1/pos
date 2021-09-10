<!DOCTYPE html>
<html>
<head>
  <title>পেইড কাস্টমার এর তালিকা</title>
  <link rel="stylesheet" href="{{asset('public/backend/pdf')}}/bootstrap.min.css">
  <style type="text/css">
    body {
      font-family: 'nikoshban',sans-serif;
    }
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
    table tr th{
      padding: 5px;
    }

    .table-bordered thead th, .table-bordered td, .table-bordered th{
      border: 1px solid black !important;
    }

    .table-bordered thead th{
      background-color:  #cacaca; 
    }
</style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <table width="100%">
          <tbody>
            <tr>
              <td width="20%"></td>
              <td width="45%" class="text-center">
                <p style="font-size: 30px; color: #2A70A1;font-weight: bold;">মেসার্স নির্মাণ</p>
                <p style="font-size: 20px;background: #1781BF;padding: 3px 15px 3px 15px;color: #fff;">প্রো:- নূরুল ইসলাম</p>
                <p style="font-size: 20px;">রড , সিমেন্ট ও টিন বিক্রেতা ।</p>
                <p style="font-size: 20px;">টিনপট্টি , পুরানথানা , কিশোরগঞ্জ ।</p>
              </td>
              <td width="35%">
                <p style="font-size: 20px;">দোকান : ০১৭১১ ৬৮৭৩৫৮</p>
                <p style="font-size: 20px;">সরাসরি মালিক : ০১৭১১ ৫৮৮৬৩২</p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-12">
        <p style="text-align: center;margin-bottom: 0px;font-weight: bold;font-size: 20px;"><u>পেইড কাস্টমার এর তালিকা</u></p>
      	<hr>
      </div>
      <div class="col-md-12">
        <table class="table table-bordered table-striped dt-responsive nowrap" style="width: 100%">
            <thead>
              <tr>
                <th>সিরিয়াল</th>
                <th>কাস্টমারের নাম</th>
                <th>মেমো নম্বর</th>
                <th>তারিখ</th>
                <th>পরিমাণ</th>
              </tr>
            </thead>
            <tbody>
              @php
                $grand_total = 0;
              @endphp
              @foreach ($allData as $key => $payment)
              <tr class="{{$payment->id}}">
                <td>{{$key+1}}</td>
                <td>
                  {{$payment['customer']['name']}} - {{$payment['customer']['mobile']}} ({{$payment['customer']['address']}})
                </td>
                <td># {{$payment['invoice']['invoice_no']}}</td>
                <td> {{date('d-m-Y',strtotime($payment['invoice']['date']))}}</td>
                <td>{{round($payment->paid_amount, 2)}} টাকা</td>
                @php
                  $grand_total += $payment->paid_amount;
                @endphp
              </tr>
              @endforeach
              <tr>
                <td class="text-right" colspan="4"><strong>সর্বমোট</strong></td>
                <td><strong>{{$grand_total}} টাকা</strong></td>
              </tr>
            </tbody>
          </table>
        @php
          $date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        @endphp
        <i style="font-size: 11px; float: right;">প্রিন্টিং তারিখ: {{$date->format('F j, Y, g:i a')}} </i>
      </div><br/>
      <div class="col-md-12">
	      <table border="0" width="100%">
	        <tbody>
	          <tr>
	            <td style="width: 30%"></td>
	            <td style="width: 30%"></td>
	            <td style="width: 40%; text-align: center;">
	              <hr style="border: solid 1px; width: 40%; color: #000; margin-bottom: 0px;">
	              <p style="text-align: center;">মালিকের স্বাক্ষর</p>
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