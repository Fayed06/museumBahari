<?php

use App\Http\Controllers\SubmissionController;

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

 // Submission Link
Route::post('/link/submit', [App\Http\Controllers\Api\SubmissionController::class, 'submit']);

// Barang
Route::get('/barang', [App\Http\Controllers\Api\BarangController::class, 'getAll']);
Route::get('/barang/{id}', [App\Http\Controllers\Api\BarangController::class, 'getOneById']);

// Event
Route::get('/event', [App\Http\Controllers\Api\EventController::class, 'getAll']);
Route::get('/event/{id}', [App\Http\Controllers\Api\EventController::class, 'getOneById']);

Route::post('/tickets/order', [App\Http\Controllers\Api\TicketController::class, 'store']);
Route::get('/tickets', [App\Http\Controllers\Api\TicketController::class, 'getAll']);


