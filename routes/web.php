<?php

use Illuminate\Support\Facades\Route;

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

// Regex validations
Route::pattern("id", "[0-9]+");

Route::get('/default', function () {
    return view("welcome");
});


// Home page
Route::get('/', 'PageController@index')->name("index");


// Admin
Route::group(["namespace" => "Admin", "prefix" => "admin", "middleware" => "is.admin"], function(){

    Route::get("/", "TransactionController@index")->name("admin.index");

    // Admin
    Route::get("/account", "AdminController@account")->name("account");
    Route::put("/account", "AdminController@account")->name("account.update");

    // Transactions
    Route::get("/transactions", "TransactionController@index")->name("transactions");
    Route::delete("/transactions/{id}/delete", "TransactionController@destroy")->name("transactions.delete");
    Route::get("/search", "TransactionController@search")->name("search");

    // Settings
    Route::get("/settings", "SettingsController@index")->name("settings");
    Route::put("/settings/update", "SettingsController@update")->name("settings.update");

});


// Authentcation
Route::group(["prefix" => "auth"], function(){
    Route::get("/login", "AuthController@login")->middleware("is.logged");
    Route::post("/login", "AuthController@login")->name("auth.login");
    Route::get("/logout", "AuthController@logout")->name("auth.logout");
});


// Transfer
Route::post('/verify-account', 'TransferController@verifyAccount')->name('verify-account');
Route::get('/banks', 'TransferController@getbankInfo');
Route::get('/create-recipient/{account_name}/{account_number}/{bank_code}', 'TransferController@createRecipient')->name('createRecipient');
Route::post('/transfer', 'TransferController@transfer')->name('transfer');
Route::post('/finalize-transfer', 'TransferController@finalizeTransfer')->name('finalizeTransfer');
