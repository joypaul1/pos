<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<title>PDF Report</title>
<style type="text/css">
    table {
        border-collapse: collapse;
    }

    h2 h3 {
        margin: 0;
        padding: 0;
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

    .table tbody+tbody {
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

    .text-center {
        text-align: center;
    }

    .text-right {
        text-align: right;
    }

    table tr td {
        padding: 5px;
    }

    .table-bordered thead th,
    .table-bordered td,
    .table-bordered th {
        border: 1px solid black !important;
    }

    .table-bordered thead th {
        background-color: #cacaca;
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
                <h4 style="font-weight: bold">
                    <u>
                        STOCK REPORT
                    </u>
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>Sl.</th>
                            <th>Supplier Name</th>
                            <th>Category</th>
                            <th>Unit</th>
                            <th>Product Name</th>
                            <th>C/Unit Price</th>
                            <th>C/Selling Price</th>
                            <th>In</th>
                            <th>Out</th>
                            <th>C/Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $in_grand = $out_grand = $grand_total = $total_unit_price = $total_selling_price = 0;
                        @endphp
                        @foreach ($allData as $key => $v)
                        <tr class="{{$v->id}}">
                            @php
                            $price = App\Model\PurchaseDetail::where('supplier_id',$v->supplier_id)->where('category_id',$v->category_id)->where('product_id',$v->id)->where('status','1')->latest()->first(['unit_price','selling_price']);
                            $buying_qty = App\Model\PurchaseDetail::where('supplier_id',$v->supplier_id)->where('category_id',$v->category_id)->where('product_id',$v->id)->where('status','1')->sum('buying_qty');
                            $buying_free_qty = App\Model\PurchaseDetail::where('supplier_id',$v->supplier_id)->where('category_id',$v->category_id)->where('product_id',$v->id)->where('status','1')->sum('free_quantity');
                            $total_in_qty = $buying_qty+$buying_free_qty;
                            $selling_qty = App\Model\InvoiceDetail::where('category_id',$v->category_id)->where('product_id',$v->id)->where('status','1')->sum('selling_qty');
                            $selling_free_qty = App\Model\InvoiceDetail::where('category_id',$v->category_id)->where('product_id',$v->id)->where('status','1')->sum('free_selling_qty');
                            $stock_out_qty = App\Model\StockOutDetail::where('category_id',$v->category_id)->where('product_id',$v->id)->where('status','1')->sum('quantity');
                            $total_out_qty = $selling_qty+$selling_free_qty+$stock_out_qty;
                            $stock = $total_in_qty-$total_out_qty;

                            @endphp
                            <td>{{$key+1}}</td>
                            <td>{{$v['supplier']['name']}}</td>
                            <td>{{$v['category']['name']}}</td>
                            <td>{{$v['unit']['name']}}</td>
                            <td>{{$v->name}}</td>
                            <td>{{ $price->unit_price }}</td>
                            <td>{{ $price->selling_price }}</td>
                            <td> {{round($total_in_qty,2)}} </td>
                            <td>{{round($total_out_qty,2)}}</td>
                            <td>{{$stock}}</td>
                            @php
                            $in_grand += $total_in_qty;
                            $out_grand += $total_out_qty;
                            $grand_total += $stock;
                            $total_unit_price += $price->unit_price??0;
                            $total_selling_price += $price->selling_price??0 ;
                            @endphp
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="5" class="text-right">Grand Total</td>
                            <td>{{$total_unit_price}}</td>
                            <td>{{$total_selling_price}}</td>
                            <td>{{$in_grand}}</td>
                            <td>{{$out_grand}}</td>
                            <td>{{$grand_total}}</td>
                        </tr>
                        <tr>
                    </tbody>
                </table>
                @php
                $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                @endphp
                <i style="font-size: 11px; float: right;">Printing Date: {{$dt->format('F j, Y, g:i a')}} </i>
            </div><br /><br />
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
