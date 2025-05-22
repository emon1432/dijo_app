<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api\V3', 'prefix' => 'delivery-man'], function () {
    Route::get('list', 'DeliverymanController@list');
    Route::get('list-with-details', 'DeliverymanController@listWithDetails');
    Route::get('show/{id}', 'DeliverymanController@show');
});
