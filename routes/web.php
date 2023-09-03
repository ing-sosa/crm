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

Route::get('/', function () {
    return view('facturas');
});

Route::get('/convert-xml-to-json', 'XmlToJsonController@showForm')->name('show-xml-to-json-form');
Route::post('/convert-xml-to-json', 'XmlToJsonController@convertXmlToJson')->name('convert-xml-to-json');
Route::post('/pdf-download', 'XmlToJsonController@pdfDownload')->name('pdf-download');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
