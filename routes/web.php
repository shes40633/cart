<?php

use Illuminate\Support\Facades\Auth;

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

Route::get('text',function(){
    $user = Auth::user()->role;
    dd($user);
});

Route::get('/', 'frontcontroller@index');


Route::get('/news', 'frontcontroller@news');
Route::get('/news/{id}', 'frontcontroller@news_id');

Route::get('/products', 'frontcontroller@products');
Route::get('/products/{id}', 'frontcontroller@products_id');

Route::get('/product_type', 'frontcontroller@product_type');
Route::get('/product_type/{id}', 'frontcontroller@product_type_id');



// testcart
Route::post('/addcart', 'cartcontroller@addcart');

Route::get('/getcontent', 'cartcontroller@getcontent');

Route::get('/totalcart', 'cartcontroller@totalcart');


//更改數量
Route::get('/cart', 'cartcontroller@cart')->middleware('auth');
Route::post('/changeQty', 'cartcontroller@changeQty');
Route::post('/deleteproduct_cart', 'cartcontroller@deleteproduct_cart');

// 填寫資料
Route::get('/checkdata', 'cartcontroller@checkdata');
Route::post('/checkout', 'cartcontroller@checkout');


Route::get('/checkoutend/{order_no}', 'cartcontroller@checkoutend');


Route::prefix('ecpay_cart')->group(function(){
    Route::post('notify', 'cartcontroller@notifyUrl')
        ->name('notify');
    Route::post('return', 'cartcontroller@returnUrl')
        ->name('return');
});



Auth::routes(["register" =>true,"reset"=>true,"confirm"=>true]);

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin']], function () {
    Route::get('/', 'AdminController@index');
    // 刪除vscode裡的圖片
    Route::post('/ajax_upload_img', 'AdminController@ajax_upload_img');
    Route::post('/ajax_delete_img','AdminController@ajax_delete_img');
    Route::post('/ajax_delete_productimg','AdminController@ajax_delete_productimg');



    // 訂單管理
    Route::get('order', 'ordercontroller@index');
    Route::get('order/show/{order_no}', 'ordercontroller@show');
    Route::post('order/changestatus/{order_no}', 'ordercontroller@changestatus');


    Route::get('order/select/{status}', 'ordercontroller@select'); //塞選
    Route::post('order/destroy/{order_no}', 'ordercontroller@destroy');

});



Route::group(['prefix' => 'admin', 'middleware' => ['auth','super_admin']], function () {

    // 帳號管理
    Route::get('account', 'accountController@index');
    Route::get('account/create', 'accountController@create');
    Route::post('account/store', 'accountController@store');
    Route::post('account/destroy/{id}', 'accountController@destroy');

    Route::get('product', 'ProductController@index');
    Route::get('product/create', 'ProductController@create');
    Route::post('product/store', 'ProductController@store');
    Route::get('product/edit/{id}', 'ProductController@edit');
    Route::post('product/update/{id}', 'ProductController@update');
    Route::post('product/destroy/{id}', 'ProductController@destroy');

    Route::get('news', 'NewsController@index');
    Route::get('news/create', 'NewsController@create');
    Route::post('news/store', 'NewsController@store');
    Route::get('news/edit/{id}', 'NewsController@edit');
    Route::post('news/update/{id}', 'NewsController@update');
    Route::post('news/destroy/{id}', 'NewsController@destroy');

    Route::get('product_type', 'product_typeController@index');
    Route::get('product_type/create', 'product_typeController@create');
    Route::post('product_type/store', 'product_typeController@store');
    Route::get('product_type/edit/{id}', 'product_typeController@edit');
    Route::post('product_type/update/{id}', 'product_typeController@update');
    Route::post('product_type/destroy/{id}', 'product_typeController@destroy');


});
