<?php

use App\Http\Controllers\Api\SubmissionController;
use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\TicketController;

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Tag
    Route::apiResource('tags', 'TagApiController');

    // Review
    Route::post('reviews/media', 'ReviewApiController@storeMedia')->name('reviews.storeMedia');
    Route::apiResource('reviews', 'ReviewApiController');

    // Recommendation
    Route::post('recommendations/media', 'RecommendationApiController@storeMedia')->name('recommendations.storeMedia');
    Route::apiResource('recommendations', 'RecommendationApiController');

    // Brand
    Route::post('brands/media', 'BrandApiController@storeMedia')->name('brands.storeMedia');
    Route::apiResource('brands', 'BrandApiController');

    // Order Ticket
    Route::post('order-tickets/media', 'OrderTicketApiController@storeMedia')->name('order-tickets.storeMedia');
    Route::apiResource('order-tickets', 'OrderTicketApiController');

    // Event
    Route::post('events/media', 'EventApiController@storeMedia')->name('events.storeMedia');
    Route::apiResource('events', 'EventApiController');

    // Submission Link
    Route::apiResource('submission-links', 'SubmissionLinkApiController');


});

Route::group(['namespace' => 'Api/V1'], function () {
    // Submission Link
    Route::post('/link/submit', "SubmissionController@submit");

    // Barang
    Route::get('/barang', "BarangController@getAll");
    Route::get('/barang/{id}', "BarangController@getOneById");

    // Event
    Route::get('/event', "EventController@getAll");
    Route::get('/event/{id}', "EventController@getOneById");

    // Ticket
    Route::post('/tickets/order', "TicketController@store");
    Route::get('/tickets', "TicketController@getAll");
});

 // Submission Link
// Route::post('/link/submit', [SubmissionController::class, 'submit']);

// Barang
// Route::get('/barang', [BarangController::class, 'getAll']);
// Route::get('/barang/{id}', [BarangController::class, 'getOneById']);

// Event
// Route::get('/event', [EventController::class, 'getAll']);
// Route::get('/event/{id}', [EventController::class, 'getOneById']);

// Route::post('/tickets/order', [TicketController::class, 'store']);
// Route::get('/tickets', [TicketController::class, 'getAll']);


