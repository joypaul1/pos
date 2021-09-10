<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::get('/', function () {
//     return view('welcome');
// });

use Illuminate\Support\Facades\Route;

Route::get('/', 'Frontend\FrontendController@index');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('admin-home', 'Backend\HomeController@index')->name('admin.home');

    Route::get('get-product-category', 'Backend\DefaultController@getProductCategory')->name('get-product-category');
    Route::get('get-category', 'Backend\DefaultController@getCategory')->name('get-category');
    Route::get('get-product', 'Backend\DefaultController@getProduct')->name('get-product');
    Route::get('get-product-count', 'Backend\DefaultController@getProductCount')->name('get-product-count');
    Route::get('get-product-stock', 'Backend\DefaultController@getProductStock')->name('get-product-stock');

    Route::prefix('user')->group(function () {
        Route::get('/view', 'Backend\User\UserController@index')->name('user.view');
        Route::get('/add', 'Backend\User\UserController@add')->name('user.add');
        Route::post('/store', 'Backend\User\UserController@store')->name('user.store');
        Route::get('/edit/{id}', 'Backend\User\UserController@edit')->name('user.edit');
        Route::post('/update/{id}', 'Backend\User\UserController@update')->name('user.update');
        Route::get('/inactive/{id}', 'Backend\User\UserController@inactive')->name('user.inactive');
        Route::get('/active/{id}', 'Backend\User\UserController@active')->name('user.active');
        Route::post('/delete', 'Backend\User\UserController@destroy')->name('user.destroy');
        // Shop Name
        Route::get('/shop/view', 'Backend\User\UserController@shopView')->name('user.shop.view');
        Route::get('/shop/add', 'Backend\User\UserController@shopAdd')->name('user.shop.add');
        Route::post('/shop/store', 'Backend\User\UserController@shopStore')->name('user.shop.store');
        Route::get('/shop/edit/{id}', 'Backend\User\UserController@shopEdit')->name('user.shop.edit');
        Route::post('/shop-update/{id}', 'Backend\User\UserController@shopUpdate')->name('user.shop.update');
    });

    Route::prefix('suppliers')->group(function () {
        Route::get('/view', 'Backend\Admin\SupplierController@index')->name('suppliers.supplier.view');
        Route::get('/add', 'Backend\Admin\SupplierController@add')->name('suppliers.supplier.add');
        Route::post('/store', 'Backend\Admin\SupplierController@store')->name('suppliers.supplier.store');
        Route::get('/edit/{id}', 'Backend\Admin\SupplierController@edit')->name('suppliers.supplier.edit');
        Route::post('/update/{id}', 'Backend\Admin\SupplierController@update')->name('suppliers.supplier.update');
        Route::post('/delete', 'Backend\Admin\SupplierController@destroy')->name('suppliers.supplier.destroy');
        Route::get('/details/{id}', 'Backend\Admin\SupplierController@details')->name('suppliers.supplier.details');
        Route::get('/report', 'Backend\Admin\SupplierController@report')->name('suppliers.supplier.report');
        Route::get('/report/handlebar', 'Backend\Admin\SupplierController@reportHandlebar')->name('suppliers.supplier.report.handlebar');
        Route::post('/report/pdf', 'Backend\Admin\SupplierController@reportPdf')->name('suppliers.supplier.report.pdf');
    });

    Route::prefix('customers')->group(function () {
        Route::get('/view', 'Backend\Admin\CustomerController@index')->name('customers.customer.view');
        Route::get('/add', 'Backend\Admin\CustomerController@add')->name('customers.customer.add');
        Route::post('/store', 'Backend\Admin\CustomerController@store')->name('customers.customer.store');
        Route::get('/edit/{id}', 'Backend\Admin\CustomerController@edit')->name('customers.customer.edit');
        Route::post('/update/{id}', 'Backend\Admin\CustomerController@update')->name('customers.customer.update');
        Route::post('/delete', 'Backend\Admin\CustomerController@destroy')->name('customers.customer.destroy');
        Route::get('/details', 'Backend\Admin\CustomerController@details')->name('customers.customer.details');
        Route::get('/report', 'Backend\Admin\CustomerController@report')->name('customers.customer.report');
        Route::post('/report/pdf', 'Backend\Admin\CustomerController@reportPdf')->name('customers.customer.report.pdf');
        Route::get('/report/handlebar', 'Backend\Admin\CustomerController@reportHandlebar')->name('customers.customer.report.handlebar');
        Route::get('/credit-paid/report', 'Backend\Admin\CustomerController@creditPaidReport')->name('customers.credit-paid.report');
        Route::post('/credit-paid/pdf', 'Backend\Admin\CustomerController@creditPaidPdf')->name('customers.credit-paid.pdf');
        Route::get('/credit-paid/handlebar', 'Backend\Admin\CustomerController@creditPaidHandlebar')->name('customers.credit-paid.handlebar');
    });

    Route::prefix('units')->group(function () {
        Route::get('/unit/view', 'Backend\Admin\UnitController@index')->name('units.unit.view');
        Route::get('/unit/add', 'Backend\Admin\UnitController@add')->name('units.unit.add');
        Route::post('/unit/store', 'Backend\Admin\UnitController@store')->name('units.unit.store');
        Route::get('/unit/edit/{id}', 'Backend\Admin\UnitController@edit')->name('units.unit.edit');
        Route::post('/unit/update/{id}', 'Backend\Admin\UnitController@update')->name('units.unit.update');
        Route::post('/unit/delete', 'Backend\Admin\UnitController@destroy')->name('units.unit.destroy');
    });

    Route::prefix('categories')->group(function () {
        Route::get('/category/view', 'Backend\Admin\CategoryController@index')->name('categories.category.view');
        Route::get('/category/add', 'Backend\Admin\CategoryController@add')->name('categories.category.add');
        Route::post('/category/store', 'Backend\Admin\CategoryController@store')->name('categories.category.store');
        Route::get('/category/edit/{id}', 'Backend\Admin\CategoryController@edit')->name('categories.category.edit');
        Route::post('/category/update/{id}', 'Backend\Admin\CategoryController@update')->name('categories.category.update');
        Route::post('/category/delete', 'Backend\Admin\CategoryController@destroy')->name('categories.category.destroy');
    });

    Route::prefix('products')->group(function () {
        Route::get('/product/view', 'Backend\Admin\ProductController@index')->name('products.product.view');
        Route::get('/product/add', 'Backend\Admin\ProductController@add')->name('products.product.add');
        Route::post('/product/store', 'Backend\Admin\ProductController@store')->name('products.product.store');
        Route::get('/product/edit/{id}', 'Backend\Admin\ProductController@edit')->name('products.product.edit');
        Route::post('/product/update/{id}', 'Backend\Admin\ProductController@update')->name('products.product.update');
        Route::post('/product/delete', 'Backend\Admin\ProductController@destroy')->name('products.product.destroy');
    });

    Route::prefix('purchases')->group(function () {
        Route::get('/view', 'Backend\Admin\PurchaseController@index')->name('purchases.purchase.view');
        Route::get('/due', 'Backend\Admin\PurchaseController@dueList')->name('purchases.purchase.due');
        Route::get('/add', 'Backend\Admin\PurchaseController@add')->name('purchases.purchase.add');
        Route::post('/store', 'Backend\Admin\PurchaseController@store')->name('purchases.purchase.store');
        Route::get('/edit/{purchase_id}', 'Backend\Admin\PurchaseController@purchaseEdit')->name('purchases.purchase.edit');
        Route::post('/update/{purchase_id}', 'Backend\Admin\PurchaseController@purchaseUpdate')->name('purchases.purchase.update');
        Route::get('/approval/{id}', 'Backend\Admin\PurchaseController@purchaseApproval')->name('purchases.purchase.approval');
        Route::post('/approval/store/{id}', 'Backend\Admin\PurchaseController@purchaseApprovalStore')->name('purchases.purchase.approval.store');
        Route::post('/update-approval/store/{id}', 'Backend\Admin\PurchaseController@purchaseUpdateApprovalStore')->name('purchases.purchase.update-approval.store');
        Route::get('/purchase-reject', 'Backend\Admin\PurchaseController@purchaseReject')->name('purchases.purchase.reject');
        Route::post('/delete', 'Backend\Admin\PurchaseController@destroy')->name('purchases.purchase.destroy');
        Route::get('/pdf/{id}', 'Backend\Admin\PurchaseController@purchasePdf')->name('purchases.purchase.pdf');
        Route::get('/details/{purchase_id}', 'Backend\Admin\PurchaseController@purchaseDetails')->name('purchases.purchase.details');
        Route::get('/daily/purchase', 'Backend\Admin\PurchaseController@dailyPurchase')->name('purchases.purchase.date.wise');
        Route::post('/daily/purchase/pdf', 'Backend\Admin\PurchaseController@dailyPurchasePdf')->name('purchases.purchase.date.wise.pdf');
        Route::get('/daily/purchase/handlebar', 'Backend\Admin\PurchaseController@dailyPurchaseHandlebar')->name('purchases.purchase.date.wise.handlebar');
    });

    Route::prefix('invoices')->group(function () {
        Route::get('/view', 'Backend\Admin\InvoiceController@index')->name('invoices.invoice.view');
        Route::get('/due', 'Backend\Admin\InvoiceController@dueList')->name('invoices.invoice.due');
        Route::get('/add', 'Backend\Admin\InvoiceController@add')->name('invoices.invoice.add');
        Route::post('/store', 'Backend\Admin\InvoiceController@store')->name('invoices.invoice.store');
        Route::get('/edit/{id}', 'Backend\Admin\InvoiceController@invoiceEdit')->name('invoices.invoice.edit');
        Route::post('/update/{id}', 'Backend\Admin\InvoiceController@invoiceUpdate')->name('invoices.invoice.update');
        Route::get('/approve/{id}', 'Backend\Admin\InvoiceController@invoiceApprove')->name('invoices.invoice.approve-get');
        Route::post('/approve/{id}', 'Backend\Admin\InvoiceController@invoiceApproveStore')->name('invoices.invoice.approve');
        Route::post('/update-approve/{id}', 'Backend\Admin\InvoiceController@invoiceUpdateApprove')->name('invoices.invoice.update-approve');
        Route::get('/update-reject', 'Backend\Admin\InvoiceController@updateReject')->name('invoices.invoice.update-reject');
        Route::post('/delete', 'Backend\Admin\InvoiceController@destroy')->name('invoices.invoice.destroy');
        Route::get('/pdf/{id}', 'Backend\Admin\InvoiceController@invoicePdf')->name('invoices.invoice.pdf');
        Route::get('/details/{id}', 'Backend\Admin\InvoiceController@invoiceDetails')->name('invoices.invoice.details');
        Route::get('/daily/invoice', 'Backend\Admin\InvoiceController@dailyInvoice')->name('invoices.invoice.date.wise');
        Route::post('/daily/invoice/pdf', 'Backend\Admin\InvoiceController@dailyInvoicePdf')->name('invoices.invoice.date.wise.pdf');
        Route::get('/daily/invoice/handlebar', 'Backend\Admin\InvoiceController@dailyInvoiceHandlebar')->name('invoices.invoice.date.wise.handlebar');
        Route::get('/customer/due-balance', 'Backend\Admin\InvoiceController@customerDueBalance')->name('invoices.customer-due-balance');
    });

    Route::prefix('stocks')->group(function () {
        //Contactor Type
        Route::get('/reason/view', 'Backend\Admin\Contactor\ContactorTypeController@index')->name('stocks.reason.view');
        Route::get('/reason/add', 'Backend\Admin\Contactor\ContactorTypeController@add')->name('stocks.reason.add');
        Route::post('/reason/store', 'Backend\Admin\Contactor\ContactorTypeController@store')->name('stocks.reason.store');
        Route::get('/reason/edit/{id}', 'Backend\Admin\Contactor\ContactorTypeController@edit')->name('stocks.reason.edit');
        Route::post('/reason/update/{id}', 'Backend\Admin\Contactor\ContactorTypeController@update')->name('stocks.reason.update');
        //Stock Out
        Route::get('/view', 'Backend\Admin\StockController@index')->name('stocks.stock.view');
        Route::get('/add', 'Backend\Admin\StockController@add')->name('stocks.stock.add');
        Route::post('/store', 'Backend\Admin\StockController@store')->name('stocks.stock.store');
        Route::get('/approve/{id}', 'Backend\Admin\StockController@approveStkOut')->name('stocks.stock.approve');
        Route::post('/approve/store/{id}', 'Backend\Admin\StockController@approveStore')->name('stocks.stock.approve.store');
        Route::post('/delete', 'Backend\Admin\StockController@destroy')->name('stocks.stock.destroy');
        Route::get('/pdf/{id}', 'Backend\Admin\StockController@pdfStockOut')->name('stocks.stock.pdf');
        Route::get('/report', 'Backend\Admin\StockController@stockReport')->name('stocks.stock.report');
        Route::post('/report/pdf', 'Backend\Admin\StockController@stockReportPdf')->name('stocks.stock.report.pdf');
        Route::get('/report/handlebar', 'Backend\Admin\StockController@stockReportHandlebar')->name('stocks.stock.report.handlebar');
    });

    Route::prefix('expanses')->group(function () {
        //Expanse Type
        Route::get('/type/view', 'Backend\Admin\ExpanseTypeController@viewType')->name('expanses.type.view');
        Route::get('/type/add', 'Backend\Admin\ExpanseTypeController@addType')->name('expanses.type.add');
        Route::post('/type/store', 'Backend\Admin\ExpanseTypeController@storeType')->name('expanses.type.store');
        Route::get('/type/edit/{id}', 'Backend\Admin\ExpanseTypeController@editType')->name('expanses.type.edit');
        Route::post('/type/update/{id}', 'Backend\Admin\ExpanseTypeController@updateType')->name('expanses.type.update');
        //Expanse
        Route::get('/expanse/view', 'Backend\Admin\ExpanseController@index')->name('expanses.expanse.view');
        Route::get('/expanse/add', 'Backend\Admin\ExpanseController@add')->name('expanses.expanse.add');
        Route::post('/expanse/store', 'Backend\Admin\ExpanseController@store')->name('expanses.expanse.store');
        Route::get('/expanse/edit/{id}', 'Backend\Admin\ExpanseController@edit')->name('expanses.expanse.edit');
        Route::post('/expanse/update/{id}', 'Backend\Admin\ExpanseController@update')->name('expanses.expanse.update');
        Route::post('/expanse/delete', 'Backend\Admin\ExpanseController@delete')->name('expanses.expanse.delete');
        Route::get('/expanse/approve/{id}', 'Backend\Admin\ExpanseController@approveGet')->name('expanses.expanse.approve.get');
        Route::post('/expanse/approve', 'Backend\Admin\ExpanseController@approve')->name('expanses.expanse.approve');
        Route::get('/expanse/attach/{id}', 'Backend\Admin\ExpanseController@attach')->name('expanses.expanse.attach');
        Route::get('/daily/report', 'Backend\Admin\ExpanseController@dailyExpanse')->name('expanses.expanse.date.wise');
        Route::get('/daily/report/handlebar', 'Backend\Admin\ExpanseController@dailyExpanseHandlebar')->name('expanses.expanse.date.wise.handlebar');
        Route::post('/daily/report/pdf', 'Backend\Admin\ExpanseController@dailyExpansePdf')->name('expanses.expanse.date.wise.pdf');
    });

    Route::prefix('profits')->group(function () {
        Route::get('/report', 'Backend\Admin\ReportController@viewReport')->name('profits.report.view');
        Route::get('/report/handlebar', 'Backend\Admin\ReportController@reportHandlebar')->name('profits.report.handlebar');
        Route::post('/report/pdf', 'Backend\Admin\ReportController@reportPdf')->name('profits.report.pdf');
    });

    Route::prefix('profile')->group(function () {
        //Profile
        Route::get('/user/view', 'Backend\User\ProfileController@adminProfile')->name('profile.user.view');
        Route::get('/user/edit/{id}', 'Backend\User\ProfileController@adminProfileEdit')->name('profile.user.edit');
        Route::post('/user/update/{id}', 'Backend\User\ProfileController@adminProfileUpdate')->name('profile.user.update');
        //Password Change
        Route::get('/password', 'Backend\User\ProfileController@viewPasswordChange')->name('profile.user.password');
        Route::post('/password/update', 'Backend\User\ProfileController@passwordUpdate')->name('profile.user.password.update');
    });

});

// Route::any('Schema', function () {

//     $dropTable = ['invoice_repayments', 'invoice_payments', 'invoice_payment_due_logs', 'invoice_payment_details', 'invoice_installments',  'invoice_details', 'invoices'];

//     foreach($dropTable as $key=>$table){

//         Illuminate\Support\Facades\Schema::dropIfExists($table);
//     }
// });
