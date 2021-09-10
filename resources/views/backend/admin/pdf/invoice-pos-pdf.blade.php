<!DOCTYPE html>
<html>
<head>
  <title>ক্যাশ মেমো</title>
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
              <td width="20%"><p style="font-size: 20px;">মেমো নম্বর : # {{$invoice->invoice_no}}</p></td>
              <td width="45%" class="text-center">
                <p style="font-size: 20px;background: #1781BF;padding: 3px 10px 3px 10px;color: #fff;">ক্যাশ মেমো</p>
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
      	<hr>
      </div>
      <div class="col-md-12">
      	@php
      		$payment = App\Model\Payment::where('invoice_id',$invoice->id)->first();
      	@endphp
        <table width="100%" style="padding-top: -15px;">
        	<tbody>
            <tr>
              <td width="40%"></td>
              <td width="40%"></td>
              <td width="20%" class="text-right">
                <p style="font-size: 18px;border-bottom: 1px dotted #000;">তারিখ : {{date('d-m-Y',strtotime($invoice->date))}}</p>
              </td>
            </tr>
        		<tr>
        			<td width="25%">
        				<p style="font-size: 18px;border-bottom: 1px dotted #000;width: 100%">নাম : {{$payment['customer']['name']}}</p>
        			</td>
        			<td width="25%">
        				<p style="font-size: 18px;border-bottom: 1px dotted #000;width: 100%">মোবাইল : {{$payment['customer']['mobile']}}</p>
        			</td>
        			<td width="50%">
        				<p style="font-size: 18px;border-bottom: 1px dotted #000;width: 100%">ঠিকানা : {{$payment['customer']['address']}}</p>
        			</td>
        		</tr>
            <tr>
              <td width="100%">
                <p style="font-size: 18px;">বিবরণ : {{$invoice->description}}</p>
              </td>
            </tr>
        	</tbody>
        </table>
      </div><br/>
      <div class="col-md-12">
        <table border="1" width="100%">
          <thead>
            <tr>
              <th>সিরিয়াল</th>
              <th>পণ্যের নাম</th>
              <th>পিস/কেজি</th>
              <th>হার</th>
              <th>মূল্য</th>
            </tr>
          </thead>
          <tbody>
            @php
              $product_sale_sum = 0;
            @endphp
          	@foreach($invoice['invoice_details'] as $key => $details)
            <tr>
            	<td>{{$key+1}}</td>
            	<td>{{$details['product']['name']}}</td>
            	<td>{{$details->selling_qty}}</td>
            	<td>{{$details->unit_price}} টাকা</td>
            	<td>{{$details->selling_price}} টাকা</td>
              @php
                $product_sale_sum += $details->selling_price;
              @endphp
            </tr>
            @endforeach
            <tr>
            	<td colspan="3" rowspan="7"></td>
            	<td><p style="font-weight: bold;">মোট</p></td>
            	<td><p style="font-weight: bold;">{{$product_sale_sum}} টাকা</p></td>
            </tr>
            <tr>
            	<td><p>শ্রমিক খরচ</p></td>
            	<td><p>{{$payment->labour_cost}} টাকা</p></td>
            </tr>
            <tr>
              <td><p style="font-weight: bold;">উপ মোট</p></td>
              <td><p style="font-weight: bold;">{{$product_sale_sum+$payment->labour_cost}} টাকা</p></td>
            </tr>
            <tr>
              <td><p>ডিসকাউন্ট</p></td>
              <td><p>{{$payment->discount_amount}} টাকা</p></td>
            </tr>
            <tr>
              <td><p style="font-weight: bold;">সর্বমোট</p></td>
              <td><p style="font-weight: bold;">{{round($payment->total_amount, 2)}} টাকা</p></td>
            </tr>
            <tr>
              <td><p style="font-weight: bold;">অর্থ প্রদান</p></td>
              <td><p style="font-weight: bold;">{{$payment->paid_amount}} টাকা</p></td>
            </tr>
            <tr>
            	<td><p style="font-weight: bold;">বাকি</p></td>
            	<td><p style="font-weight: bold;">{{round($payment->due_amount, 2)}} টাকা</p></td>
            </tr>
          </tbody>
        </table>
        @php
          $date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        @endphp
        <i style="font-size: 11px; float: right;">প্রিন্টিং তারিখ: {{$date->format('F j, Y, g:i a')}} </i>
      </div><br/><br/>
      <div class="col-md-12">
        <hr style="margin-bottom: 0px;">
	      <table border="0" width="100%">
	        <tbody>
	          <tr>
	            <td style="width: 40%; ">
                <p style="text-align: center;margin-left: : 20px;">ক্রেতার স্বাক্ষর</p> 
              </td>
	            <td style="width: 20%"></td>
	            <td style="width: 40%; text-align: center;">
	              <p style="text-align: center;">বিক্রেতার স্বাক্ষর</p>
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