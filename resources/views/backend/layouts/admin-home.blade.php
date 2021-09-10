@extends('backend.layouts.master')
@section('content')
<style type="text/css">
    h4{
        padding-top:10px;
    }
    .card_body{
        border-radius: 10px; 
        text-align: center;
    }
    .card-clock{
        background: transparent;
        border:none;
    }
</style>
<div class="content-page">
    
    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left">Dashboard</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row mb-3">
                <div class="col-sm-3">
                    <div style="background: #1B9D5E; padding: 10px; border-radius: 10px; text-align: center;">
                        <a href="{{route('customers.credit-paid.report')}}" style="color: #fff;">
                            <i class="fa fa-users bigfonts" aria-hidden="true" style="font-size: 50px"></i><i class="fab fa-intercom"></i>
                            <br/> Credit/Paid by Customer
                        </a>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div style="background: #517fa4; padding: 10px; border-radius: 10px; text-align: center;">
                        <a href="{{route('customers.customer.view')}}" style="color: #fff;"><i class="fa fa-folder bigfonts" aria-hidden="true" style="font-size: 50px"></i><br/> Customers</a>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div style="background: #82C91E; padding: 10px; border-radius: 10px; text-align: center;">
                        <a href="{{route('suppliers.supplier.view')}}" style="color: #fff;">
                            <i class="fa fa-folder-open bigfonts" aria-hidden="true" style="font-size: 50px"></i>
                            <br/> Suppliers
                        </a>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div style="background: #339AF0; padding: 10px; border-radius: 10px; text-align: center;">
                        <a href="{{route('purchases.purchase.view')}}" style="color: #fff;"><i class="fa fa-file" aria-hidden="true" style="font-size: 50px"></i><br/> Purchase</a>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row mb-3">
                <div class="col-sm-3">
                    <div style="background: #FC6440; padding: 10px; border-radius: 10px; text-align: center;">
                        <a href="{{route('products.product.view')}}" style="color: #fff;">
                            <i class="fa fa-list" aria-hidden="true" style="font-size: 50px"></i><i class="fab fa-intercom"></i>
                            <br/> Products
                        </a>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div style="background: #F1B53D; padding: 10px; border-radius: 10px; text-align: center;">
                        <a href="{{route('stocks.stock.report')}}" style="color: #fff;">
                            <i class="fa fa-folder-open bigfonts" aria-hidden="true" style="font-size: 50px"></i>
                            <br/> Stocks Reports
                        </a>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div style="background: #517fa4; padding: 10px; border-radius: 10px; text-align: center;">
                        <a href="{{route('invoices.invoice.date.wise')}}" style="color: #fff;"><i class="fa fa-folder bigfonts" aria-hidden="true" style="font-size: 50px"></i><br/> Daily Sales</a>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div style="background: #1B9D5E; padding: 10px; border-radius: 10px; text-align: center;">
                        <a href="{{route('expanses.expanse.date.wise')}}" style="color: #fff;"><i class="fa fa-list" aria-hidden="true" style="font-size: 50px"></i><br/> Daily Expanse</a>
                    </div>
                </div>
            </div><br/>

            <div class="row">
                <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Profit Report
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{route('profits.report.pdf')}}" id="myForm" target="_blank">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label>Start Date</label>
                                        <input type="text" name="start_date" id="start_date" class="form-control form-control-sm singledatepicker" placeholder="YYYY-MM-DD" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label>End Date</label>
                                        <input type="text" name="end_date" id="end_date" class="form-control form-control-sm singledatepicker" placeholder="YYYY-MM-DD" readonly>
                                    </div>
                                    <div class="col-md-3" style="padding-top:30px;">
                                        <a class="btn btn-primary btn-sm" id="search"><i class="fa fa-search"></i> Search</a>
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-download"></i> Download</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-header">
                           <h5 style="color: red;" > <marquee ‍> 
                                প্রত্যেক মাসের সফটওয়্যার বিল ২৮ থেকে ৩১ তারিখের মধ্যেই বিকাশ এ ‍বিল পরিশোধ করার জন্য অনুরোধ করা হল।  (পার্সোনাল বিকাশ নাম্বার  - ০১৭৬৭-১৮৯৭৯৯)  বিঃদ্রঃ কোন কারণে যদি বিল পরিশোধ করতে  প্রতিষ্ঠানটি ব্যর্থ হয় তাহলে সাময়িক  সময়ের জন্য সফটয়্যারটি বন্ধ হয়ে যাবে বিল পরিশোধ করার কয়েক মিনিটের মধ্যেই আবার পূর্ণরায় সফটয়্যারটি চালু  হয়ে যাবে। বিস্তারিত জানতে কল করুন ০১৭৬৭-১৮৯৭৯৯ ।
                            </marquee>
                        </div>

                        <div class="card-body">
                            <div id="DocumentResults"></div>
                            <script id="document-template" type="text/x-handlebars-template">
                            <table class="table-sm table-bordered table-striped dt-responsive" style="width: 100%">
                                <tbody>
                                    @{{{tdsource}}}
                                </tbody>
                            </table>
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div>
        <!-- END container-fluid -->

    </div>
    <!-- END content -->

</div>
<!-- END content-page -->
<script type="text/javascript">
    $("#myForm").submit(function( event ) {
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        if (start_date == ''){
            $('.notifyjs-corner').html('');
            $.notify("Start Date is required", {globalPosition: 'top right',className: 'error'});
            event.preventDefault();
        }else{
            return true;
        }
        if (end_date == ''){
            $('.notifyjs-corner').html('');
            $.notify("End Date is required", {globalPosition: 'top right',className: 'error'});
            event.preventDefault();
        }else{
            return true;
        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $(document).on("click","#search", function () {
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            if(start_date==''){
                $.notify("Start Date is required", {globalPosition: 'top right',className: 'error'});
                return false;
            }
            if(end_date==''){
                $.notify("End Date is required", {globalPosition: 'top right',className: 'error'});
                return false;
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).on('click','#search',function(){
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        $.ajax({
            url: "{{route('profits.report.handlebar')}}",
            type: "get",
            data: {
                'start_date': start_date,
                'end_date': end_date,
            },
            beforeSend: function() {
            },
            success: function (data) {
                var source = $("#document-template").html();
                var template = Handlebars.compile(source);
                var html = template(data);
                $('#DocumentResults').html(html);
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    });
</script>
@endsection