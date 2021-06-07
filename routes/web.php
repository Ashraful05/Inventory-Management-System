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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//All backend route is here...
Route::get('/home',[
    'uses' => 'HomeController@index',
    'as'   => '/dashboard'
]);
//User route is here.....
Route::group(['middleware'=>'auth'],function(){
    Route::prefix('users')->group(function(){
        Route::get('/add',[
            'uses' => 'Backend\UserController@addUser',
            'as'   => 'add-user'
        ]);
        Route::post('/save',[
            'uses' => 'Backend\UserController@saveUser',
            'as'   => 'save-user'
        ]);
        Route::get('/view',[
            'uses' => 'Backend\UserController@viewUser',
            'as'   => 'view-user'
        ]);
        Route::get('/edit/{id}',[
            'uses' => 'Backend\UserController@editUser',
            'as'   => 'edit-user'
        ]);
        Route::post('/update',[
            'uses' => 'Backend\UserController@updateUser',
            'as'   => 'update-user'
        ]);
        Route::get('/delete/{id}',[
            'uses' => 'Backend\UserController@deleteUser',
            'as'   => 'delete-user'
        ]);
    });
    Route::prefix('profiles')->group(function(){
        Route::get('/view',[
            'uses' => 'Backend\ProfileController@viewProfile',
            'as'   => 'view-profile'
        ]);
        Route::get('/edit/{id}',[
            'uses' => 'Backend\ProfileController@editProfile',
            'as'   => 'edit-profile'
        ]);
        Route::post('/update',[
            'uses' => 'Backend\ProfileController@updateProfile',
            'as'   => 'update-profile'
        ]);
        Route::get('/password',[
            'uses' => 'Backend\ProfileController@changePassword',
            'as'   => 'change-password'
        ]);
        Route::post('/update-password',[
            'uses' => 'Backend\ProfileController@updatePassword',
            'as'   => 'update-password'
        ]);
    });
    Route::prefix('suppliers')->group(function(){
        Route::get('/add',[
            'uses' => 'Backend\SupplierController@addSupplier',
            'as'   => 'add-supplier'
        ]);
        Route::post('/save',[
            'uses' => 'Backend\SupplierController@saveSupplier',
            'as'   => 'save-supplier'
        ]);
        Route::get('/view',[
            'uses' => 'Backend\SupplierController@viewSupplier',
            'as'   => 'view-supplier'
        ]);
        Route::get('/edit/{id}',[
            'uses' => 'Backend\SupplierController@editSupplier',
            'as'   => 'edit-supplier'
        ]);
        Route::post('/update',[
            'uses' => 'Backend\SupplierController@updateSupplier',
            'as'   => 'update-supplier'
        ]);
        Route::get('/delete/{id}',[
            'uses' => 'Backend\SupplierController@deleteSupplier',
            'as'   => 'delete-supplier'
        ]);
    });
    Route::prefix('customer')->group(function(){
        Route::get('/add',[
            'uses' => 'Backend\CustomerController@addCustomer',
            'as'   => 'add-customer'
        ]);
        Route::post('/save',[
            'uses' => 'Backend\CustomerController@saveCustomer',
            'as'   => 'save-customer'
        ]);
        Route::get('/view',[
            'uses' => 'Backend\CustomerController@viewCustomer',
            'as'   => 'view-customer'
        ]);
        Route::get('/edit/{id}',[
            'uses' => 'Backend\CustomerController@editCustomer',
            'as'   => 'edit-customer'
        ]);
        Route::post('/update',[
            'uses' => 'Backend\CustomerController@updateCustomer',
            'as'   => 'update-customer'
        ]);
        Route::get('/delete/{id}',[
            'uses' => 'Backend\CustomerController@deleteCustomer',
            'as'   => 'delete-customer'
        ]);
        Route::get('/credit',[
            'uses' => 'Backend\CustomerController@creditCustomer',
            'as'   => 'credit-customer'
        ]);
        Route::get('/credit/edit/{invoice_id}',[
            'uses' => 'Backend\CustomerController@editCreditCustomer',
            'as'   => 'edit-customer-credit'
        ]);
        Route::post('/update/credit/{invoice_id}',[
            'uses' => 'Backend\CustomerController@updateCreditCustomer',
            'as'   => 'update-customer-credit'
        ]);
        Route::get('/credit/download/pdf',[
            'uses' => 'Backend\CustomerController@customerReportPDF',
            'as'   => 'download-customer-report'
        ]);
        Route::get('/credit/details/pdf/{invoice_id}',[
            'uses' => 'Backend\CustomerController@invoiceDetailsPDF',
            'as'   => 'invoice-details-pdf'
        ]);
        Route::get('/paid',[
            'uses' => 'Backend\CustomerController@paidCustomer',
            'as'   => 'paid-customer'
        ]);
        Route::get('/paid/pdf',[
            'uses' => 'Backend\CustomerController@paidCustomerPDF',
            'as'   => 'paid-customer-pdf'
          ]);
        Route::get('/wise/report',[
            'uses' => 'Backend\CustomerController@customerWiseReport',
            'as'   => 'customer-wise-report'
        ]);
        Route::get('/wise/credit/report/pdf',[
            'uses' => 'Backend\CustomerController@customerWiseCreditReportPDF',
            'as'   => 'customer-wise-credit-report-pdf'
        ]);
        Route::get('/wise/paid/report/pdf',[
            'uses' => 'Backend\CustomerController@customerWisePaidReportPDF',
            'as'   => 'customer-wise-paid-report-pdf'
        ]);
    });
    Route::prefix('units')->group(function(){
        Route::get('/add',[
            'uses' => 'Backend\UnitController@addUnit',
            'as'   => 'add-unit'
        ]);
        Route::post('/save',[
            'uses' => 'Backend\UnitController@saveUnit',
            'as'   => 'save-unit'
        ]);
        Route::get('/view',[
            'uses' => 'Backend\UnitController@viewUnit',
            'as'   => 'view-unit'
        ]);
        Route::get('/edit/{id}',[
            'uses' => 'Backend\UnitController@editUnit',
            'as'   => 'edit-unit'
        ]);
        Route::post('/update',[
            'uses' => 'Backend\UnitController@updateUnit',
            'as'   => 'update-unit'
        ]);
        Route::get('/delete/{id}',[
            'uses' => 'Backend\UnitController@deleteUnit',
            'as'   => 'delete-unit'
        ]);
    });
    Route::prefix('categories')->group(function(){
        Route::get('/add',[
            'uses' => 'Backend\CategoryController@addCategory',
            'as'   => 'add-category'
        ]);
        Route::post('/save',[
            'uses' => 'Backend\CategoryController@saveCategory',
            'as'   => 'save-category'
        ]);
        Route::get('/manage',[
            'uses' => 'Backend\CategoryController@viewCategory',
            'as'   => 'view-category'
        ]);
        Route::get('/edit/{id}',[
            'uses' => 'Backend\CategoryController@editCategory',
            'as'   => 'edit-category'
        ]);
        Route::post('/update',[
            'uses' => 'Backend\CategoryController@updateCategory',
            'as'   => 'update-category'
        ]);
        Route::get('/delete/{id}',[
            'uses' => 'Backend\CategoryController@deleteCategory',
            'as'   => 'delete-category'
        ]);
    });
    Route::prefix('products')->group(function(){
        Route::get('/add',[
            'uses' => 'Backend\ProductController@addProduct',
            'as'   => 'add-product'
        ]);
        Route::post('/save',[
            'uses' => 'Backend\ProductController@saveProduct',
            'as'   => 'save-product'
        ]);
        Route::get('/manage',[
            'uses' => 'Backend\ProductController@viewProduct',
            'as'   => 'view-product'
        ]);
        Route::get('/edit/{id}',[
            'uses' => 'Backend\ProductController@editProduct',
            'as'   => 'edit-product'
        ]);
        Route::post('/update',[
            'uses' => 'Backend\ProductController@updateProduct',
            'as'   => 'update-product'
        ]);
        Route::get('/delete/{id}',[
            'uses' => 'Backend\ProductController@deleteProduct',
            'as'   => 'delete-product'
        ]);
    });
    Route::prefix('purchase')->group(function(){
        Route::get('/add',[
            'uses' => 'Backend\PurchaseController@addPurchase',
            'as'   => 'add-purchase'
        ]);
        Route::post('/save',[
            'uses' => 'Backend\PurchaseController@savePurchase',
            'as'   => 'save-purchase'
        ]);
        Route::get('/manage',[
            'uses' => 'Backend\PurchaseController@viewPurchase',
            'as'   => 'view-purchase'
        ]);
//        Route::get('/edit/{id}',[
//            'uses' => 'Backend\PurchaseController@editPurchase',
//            'as'   => 'edit-purchase'
//        ]);
//        Route::post('/update',[
//            'uses' => 'Backend\PurchaseController@updatePurchase',
//            'as'   => 'update-purchase'
//        ]);
        Route::get('/delete/{id}',[
            'uses' => 'Backend\PurchaseController@deletePurchase',
            'as'   => 'delete-purchase'
        ]);
        Route::get('/pending',[
            'uses' => 'Backend\PurchaseController@pendingPurchase',
            'as'   => 'pending-purchase'
        ]);
        Route::get('/approve/{id}',[
            'uses' => 'Backend\PurchaseController@approvePurchase',
            'as'   => 'approve-purchase'
        ]);
        Route::get('/daily/report',[
            'uses' => 'Backend\PurchaseController@dailyPurchase',
            'as'   => 'daily-purchase-report'
        ]);
        Route::get('/daily/report/pdf',[
            'uses' => 'Backend\PurchaseController@dailyPurchasePDF',
            'as'   => 'daily-purchase-report-pdf'
        ]);
    });
    Route::prefix('invoice')->group(function(){
       Route::get('/add',[
           'uses' => 'Backend\InvoiceController@addInvoice',
           'as'   => 'add-invoice'
       ]);
       Route::post('/save',[
           'uses' => 'Backend\InvoiceController@saveInvoice',
           'as'   => 'save-invoice'
       ]);
       Route::get('/view',[
           'uses' => 'Backend\InvoiceController@viewInvoice',
           'as'   => 'view-invoice'
       ]);
        Route::get('/delete/{id}',[
            'uses' => 'Backend\InvoiceController@deleteInvoice',
            'as'   => 'delete-invoice'
        ]);
        Route::get('/pending',[
            'uses' => 'Backend\InvoiceController@pendingInvoice',
            'as'   => 'pending-invoice'
        ]);
        Route::get('/approve/{id}',[
            'uses' => 'Backend\InvoiceController@approveInvoice',
            'as'   => 'approve-invoice'
        ]);
        Route::post('/save-approve/{id}',[
            'uses' => 'Backend\InvoiceController@saveApproval',
            'as'   => 'save-approval'
        ]);
        Route::get('/list',[
            'uses' => 'Backend\InvoiceController@printInvoiceList',
            'as'   => 'invoice-list'
        ]);
        Route::get('/print/{id}',[
            'uses' => 'Backend\InvoiceController@printInvoice',
            'as'   => 'print-invoice'
        ]);
        Route::get('/report/daily',[
            'uses' => 'Backend\InvoiceController@dailyInvoiceReport',
            'as'   => 'daily-invoice-report'
        ]);
        Route::get('/report/daily/pdf',[
            'uses' => 'Backend\InvoiceController@dailyInvoiceReportPdf',
            'as'   => 'daily-invoice-report-pdf'
        ]);
    });
    Route::prefix('stock')->group(function(){
       Route::get('/report',[
           'uses' => 'Backend\StockController@viewStockReport',
           'as'   => 'view-report'
       ]);
       Route::get('/report/pdf',[
           'uses' => 'Backend\StockController@viewStockReportPDF',
           'as'   => 'view-report-pdf'
       ]);
       Route::get('/supplier-product-wise-report',[
           'uses' => 'Backend\StockController@viewSupplierProductWiseReport',
           'as'   => 'view-supplier-wise-report'
       ]);
       Route::get('/supplier-wise-report/pdf',[
           'uses' => 'Backend\StockController@viewSupplierWiseReportPDF',
           'as'   => 'view-supplier-wise-report-pdf'
       ]);
       Route::get('/product-wise-report/pdf',[
           'uses' => 'Backend\StockController@viewProductWiseReportPDF',
           'as'   => 'view-product-wise-report-pdf'
       ]);
    });
    Route::get('/get-category',[
        'uses' => 'Backend\DefaultController@getCategory',
        'as'   => 'get-category'
    ]);
    Route::get('/get-product',[
        'uses' => 'Backend\DefaultController@getProduct',
        'as'   => 'get-product'
    ]);
    Route::get('/check-product-stock',[
        'uses' => 'Backend\DefaultController@checkStock',
        'as'   => 'check-product-stock'
    ]);
});


//Profile route is here...


//Slider route is here...
Route::prefix('sliders')->group(function(){
    Route::get('/add',[
        'uses' => 'Backend\UserController@addSlider',
        'as'   => 'add-slider'
    ]);
    Route::post('/save',[
        'uses' => 'Backend\UserController@saveSlider',
        'as'   => 'save-slider'
    ]);
    Route::get('/manage',[
        'uses' => 'Backend\UserController@manageSlider',
        'as'   => 'manage-slider'
    ]);
    Route::get('/edit/{id}',[
        'uses' => 'Backend\UserController@editSlider',
        'as'   => 'edit-slider'
    ]);
    Route::post('/update',[
        'uses' => 'Backend\UserController@updateSlider',
        'as'   => 'update-slider'
    ]);
    Route::get('/delete/{id}',[
        'uses' => 'Backend\UserController@deleteSlider',
        'as'   => 'delete-slider'
    ]);
});
