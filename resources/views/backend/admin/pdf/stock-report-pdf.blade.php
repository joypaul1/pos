<!DOCTYPE html>
<html>
<head>
  <title>স্টক রিপোর্ট</title>
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
        <p style="text-align: center;margin-bottom: 0px;font-weight: bold;font-size: 20px;"><u>স্টক এর তালিকা</u></p>
      	<hr>
      </div>
      <div class="col-md-12">
        <table class="table table-bordered table-striped dt-responsive nowrap" style="width: 100%">
            <thead>
              <tr>
                <th>সিরিয়াল</th>
                <th>সাপ্লায়ারের নাম</th>
                <th>পণ্যের ধরন</th>
                <th>ইউনিট</th>
                <th>পণ্যের নাম</th>
                <th>ইন স্টক</th>
                <th>আউট স্টক</th>
                <th>কারেন্ট স্টক</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($allData as $key => $product)
                <tr class="{{$product->id}}">
                  @php
                    $total_buying_qty= App\Model\Purchase::where('category_id',$product->category_id)->where('product_id',$product->id)->where('status','1')->sum('buying_qty');
                    $total_selling_qty= App\Model\InvoiceDetail::where('category_id',$product->category_id)->where('product_id',$product->id)->where('status','1')->sum('selling_qty');
                  @endphp
                  <td>{{$key+1}}</td>
                  <td>{{$product['supplier']['name']}}</td>
                  <td>{{$product['category']['name']}}</td>
                  <td>{{$product['unit']['name']}}</td>
                  <td>{{$product->name}}</td>
                  <td>
                    {{$total_buying_qty}}
                  </td>
                  <td>
                    {{$total_selling_qty}}
                  </td>
                  <td>{{$product->quantity}}</td>
                </tr>
                @endforeach
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