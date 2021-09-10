@php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
@endphp
<!-- Left Sidebar -->
<style type="text/css">
    .sidescrollview{
        position: fixed;
        overflow-y: scroll;
    }
    
</style>
<div class="left main-sidebar sidescrollview">

    <div class="sidebar-inner leftscroll">

        <div id="sidebar-menu">
    
        <ul>

            <li class="submenu">
                <a class="active" href="{{route('admin.home')}}"><i class="fa fa-fw fa-bars"></i><span> Dashboard </span> </a>
            </li>

            <!-- Only for Customize -->
            @if(Auth::user()->usertype=='Admin')
            <li class="submenu">
               <a style="cursor:pointer" class="{{($prefix=='/user')?'active':''}}"><i class="fa fa-copy"></i> <span>Manage User</span> <span class="menu-arrow"></span></a>
               <ul class="list-unstyled" style="display: none;">
                  <li class="{{($route=='user.view')?'active':''}}">
                     <a class="{{($route=='user.view')?'active':''}}" href="{{route('user.view')}}"><i class="fa fa-circle-o {{($route=='user.view')?'text-success':''}}"></i>View User</a>
                  </li>
                  <li class="{{($route=='user.shop.view')?'active':''}}">
                     <a class="{{($route=='user.shop.view')?'active':''}}" href="{{route('user.shop.view')}}"><i class="fa fa-circle-o {{($route=='user.shop.view')?'text-success':''}}"></i>View Shop</a>
                  </li>
               </ul>
            </li>
            @endif

            <li class="submenu">
               <a style="cursor:pointer" class="{{($prefix=='/profile')?'active':''}}"><i class="fa fa-copy"></i> <span>Manage Profile</span> <span class="menu-arrow"></span></a>
               <ul class="list-unstyled" style="display: none;">
                  <li class="{{($route=='profile.user.view')?'active':''}}">
                     <a class="{{($route=='profile.user.view')?'active':''}}" href="{{route('profile.user.view')}}"><i class="fa fa-circle-o {{($route=='profile.user.view')?'text-success':''}}"></i>Your Profile</a>
                  </li>
                  <li class="{{($route=='profile.user.password')?'active':''}}">
                     <a class="{{($route=='profile.user.password')?'active':''}}" href="{{route('profile.user.password')}}"><i class="fa fa-circle-o {{($route=='profile.user.password')?'text-success':''}}"></i>Password Change</a>
                  </li>
               </ul>
            </li>

            <li class="submenu">
               <a style="cursor:pointer" class="{{($prefix=='/suppliers')?'active':''}}"><i class="fa fa-copy"></i> <span>Manage Supplier</span> <span class="menu-arrow"></span></a>
               <ul class="list-unstyled" style="display: none;">
                  <li class="{{($route=='suppliers.supplier.view')?'active':''}}">
                     <a class="{{($route=='suppliers.supplier.view')?'active':''}}" href="{{route('suppliers.supplier.view')}}"><i class="fa fa-circle-o {{($route=='suppliers.supplier.view')?'text-success':''}}"></i>View Supplier</a>
                  </li>
                  <li class="{{($route=='suppliers.supplier.report')?'active':''}}">
                     <a class="{{($route=='suppliers.supplier.report')?'active':''}}" href="{{route('suppliers.supplier.report')}}"><i class="fa fa-circle-o {{($route=='suppliers.supplier.report')?'text-success':''}}"></i>Supplier Report</a>
                  </li>
               </ul>
            </li>

            <li class="submenu">
               <a style="cursor:pointer" class="{{($prefix=='/units')?'active':''}}"><i class="fa fa-copy"></i> <span>Manage Unit</span> <span class="menu-arrow"></span></a>
               <ul class="list-unstyled" style="display: none;">
                  <li class="{{($route=='units.unit.view')?'active':''}}">
                     <a class="{{($route=='units.unit.view')?'active':''}}" href="{{route('units.unit.view')}}"><i class="fa fa-circle-o {{($route=='units.unit.view')?'text-success':''}}"></i>View Unit</a>
                  </li>
               </ul>
            </li>

            <li class="submenu">
               <a style="cursor:pointer" class="{{($prefix=='/categories')?'active':''}}"><i class="fa fa-copy"></i> <span>Manage Category</span> <span class="menu-arrow"></span></a>
               <ul class="list-unstyled" style="display: none;">
                  <li class="{{($route=='categories.category.view')?'active':''}}">
                     <a class="{{($route=='categories.category.view')?'active':''}}" href="{{route('categories.category.view')}}"><i class="fa fa-circle-o {{($route=='categories.category.view')?'text-success':''}}"></i>View Category</a>
                  </li>
               </ul>
            </li>

            <li class="submenu">
               <a style="cursor:pointer" class="{{($prefix=='/products')?'active':''}}"><i class="fa fa-copy"></i> <span>Manage Product</span> <span class="menu-arrow"></span></a>
               <ul class="list-unstyled" style="display: none;">
                  <li class="{{($route=='products.product.view')?'active':''}}">
                     <a class="{{($route=='products.product.view')?'active':''}}" href="{{route('products.product.view')}}"><i class="fa fa-circle-o {{($route=='products.product.view')?'text-success':''}}"></i>View Product</a>
                  </li>
               </ul>
            </li>

            <li class="submenu">
               <a style="cursor:pointer" class="{{($prefix=='/purchases')?'active':''}}"><i class="fa fa-copy"></i> <span>Manage Purchase</span> <span class="menu-arrow"></span></a>
               <ul class="list-unstyled" style="display: none;">
                  <li class="{{($route=='purchases.purchase.view')?'active':''}}">
                     <a class="{{($route=='purchases.purchase.view')?'active':''}}" href="{{route('purchases.purchase.view')}}"><i class="fa fa-circle-o {{($route=='purchases.purchase.view')?'text-success':''}}"></i>View Purchase</a>
                  </li>
                  <li class="{{($route=='purchases.purchase.due')?'active':''}}">
                     <a class="{{($route=='purchases.purchase.due')?'active':''}}" href="{{route('purchases.purchase.due')}}"><i class="fa fa-circle-o {{($route=='purchases.purchase.due')?'text-success':''}}"></i>Due Purchase</a>
                  </li>
                  <li class="{{($route=='purchases.purchase.date.wise')?'active':''}}">
                     <a class="{{($route=='purchases.purchase.date.wise')?'active':''}}" href="{{route('purchases.purchase.date.wise')}}"><i class="fa fa-circle-o {{($route=='purchases.purchase.date.wise')?'text-success':''}}"></i>Purchase Report</a>
                  </li>
               </ul>
            </li>

            <li class="submenu">
               <a style="cursor:pointer" class="{{($prefix=='/customers')?'active':''}}"><i class="fa fa-copy"></i> <span>Manage Customer</span> <span class="menu-arrow"></span></a>
               <ul class="list-unstyled" style="display: none;">
                  <li class="{{($route=='customers.customer.view')?'active':''}}">
                     <a class="{{($route=='customers.customer.view')?'active':''}}" href="{{route('customers.customer.view')}}"><i class="fa fa-circle-o {{($route=='customers.customer.view')?'text-success':''}}"></i>View Customer</a>
                  </li>
                  <li class="{{($route=='customers.customer.report')?'active':''}}">
                     <a class="{{($route=='customers.customer.report')?'active':''}}" href="{{route('customers.customer.report')}}"><i class="fa fa-circle-o {{($route=='customers.customer.report')?'text-success':''}}"></i>Customer Report</a>
                  </li>
                  <li class="{{($route=='customers.credit-paid.report')?'active':''}}">
                     <a class="{{($route=='customers.credit-paid.report')?'active':''}}" href="{{route('customers.credit-paid.report')}}"><i class="fa fa-circle-o {{($route=='customers.credit-paid.report')?'text-success':''}}"></i>Credit/Paid Report</a>
                  </li>
               </ul>
            </li>

            <li class="submenu">
               <a style="cursor:pointer" class="{{($prefix=='/invoices')?'active':''}}"><i class="fa fa-copy"></i> <span>Manage Sales</span> <span class="menu-arrow"></span></a>
               <ul class="list-unstyled" style="display: none;">
                  <li class="{{($route=='invoices.invoice.view')?'active':''}}">
                     <a class="{{($route=='invoices.invoice.view')?'active':''}}" href="{{route('invoices.invoice.view')}}"><i class="fa fa-circle-o {{($route=='invoices.invoice.view')?'text-success':''}}"></i>View Invoice</a>
                  </li>
                  <li class="{{($route=='invoices.invoice.due')?'active':''}}">
                     <a class="{{($route=='invoices.invoice.due')?'active':''}}" href="{{route('invoices.invoice.due')}}"><i class="fa fa-circle-o {{($route=='invoices.invoice.due')?'text-success':''}}"></i>Due Invoice</a>
                  </li>
                  <li class="{{($route=='invoices.invoice.date.wise')?'active':''}}">
                     <a class="{{($route=='invoices.invoice.date.wise')?'active':''}}" href="{{route('invoices.invoice.date.wise')}}"><i class="fa fa-circle-o {{($route=='invoices.invoice.date.wise')?'text-success':''}}"></i>Sales Report</a>
                  </li>
               </ul>
            </li>

            <li class="submenu">
               <a style="cursor:pointer" class="{{($prefix=='/stocks')?'active':''}}"><i class="fa fa-copy"></i> <span>Manage Stock</span> <span class="menu-arrow"></span></a>
               <ul class="list-unstyled" style="display: none;">
                  <li class="{{($route=='stocks.reason.view')?'active':''}}">
                     <a class="{{($route=='stocks.reason.view')?'active':''}}" href="{{route('stocks.reason.view')}}"><i class="fa fa-circle-o {{($route=='stocks.reason.view')?'text-success':''}}"></i>View Reason</a>
                  </li>
                  <li class="{{($route=='stocks.stock.view')?'active':''}}">
                     <a class="{{($route=='stocks.stock.view')?'active':''}}" href="{{route('stocks.stock.view')}}"><i class="fa fa-circle-o {{($route=='stocks.stock.view')?'text-success':''}}"></i>Stock Out</a>
                  </li>
                  <li class="{{($route=='stocks.stock.report')?'active':''}}">
                     <a class="{{($route=='stocks.stock.report')?'active':''}}" href="{{route('stocks.stock.report')}}"><i class="fa fa-circle-o {{($route=='stocks.stock.report')?'text-success':''}}"></i>Stock Report</a>
                  </li>
               </ul>
            </li>

            <li class="submenu">
               <a style="cursor:pointer" class="{{($prefix=='/expanses')?'active':''}}"><i class="fa fa-copy"></i> <span>Manage Expanse</span> <span class="menu-arrow"></span></a>
               <ul class="list-unstyled" style="display: none;">
                  <li class="{{($route=='expanses.type.view')?'active':''}}">
                     <a class="{{($route=='expanses.type.view')?'active':''}}" href="{{route('expanses.type.view')}}"><i class="fa fa-circle-o {{($route=='expanses.type.view')?'text-success':''}}"></i>Expanse Type</a>
                  </li>
                  <li class="{{($route=='expanses.expanse.view')?'active':''}}">
                     <a class="{{($route=='expanses.expanse.view')?'active':''}}" href="{{route('expanses.expanse.view')}}"><i class="fa fa-circle-o {{($route=='expanses.expanse.view')?'text-success':''}}"></i>View Expanse</a>
                  </li>
                  <li class="{{($route=='expanses.expanse.date.wise')?'active':''}}">
                     <a class="{{($route=='expanses.expanse.date.wise')?'active':''}}" href="{{route('expanses.expanse.date.wise')}}"><i class="fa fa-circle-o {{($route=='expanses.expanse.date.wise')?'text-success':''}}"></i>Expanse Report</a>
                  </li>
               </ul>
            </li>

            <li class="submenu">
               <a style="cursor:pointer" class="{{($prefix=='/profits')?'active':''}}"><i class="fa fa-copy"></i> <span>Manage Profit</span> <span class="menu-arrow"></span></a>
               <ul class="list-unstyled" style="display: none;">
                  <li class="{{($route=='profits.report.view')?'active':''}}">
                     <a class="{{($route=='profits.report.view')?'active':''}}" href="{{route('profits.report.view')}}"><i class="fa fa-circle-o {{($route=='profits.report.view')?'text-success':''}}"></i>View Profit</a>
                  </li>
               </ul>
            </li>

        </ul>

        <div class="clearfix"></div>

        </div>
    
        <div class="clearfix"></div>

    </div>

</div>
<!-- End Sidebar -->