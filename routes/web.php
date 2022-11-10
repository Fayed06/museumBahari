<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Tag
    Route::delete('tags/destroy', 'TagController@massDestroy')->name('tags.massDestroy');
    Route::resource('tags', 'TagController');

    // Review
    Route::delete('reviews/destroy', 'ReviewController@massDestroy')->name('reviews.massDestroy');
    Route::post('reviews/media', 'ReviewController@storeMedia')->name('reviews.storeMedia');
    Route::post('reviews/ckmedia', 'ReviewController@storeCKEditorImages')->name('reviews.storeCKEditorImages');
    Route::resource('reviews', 'ReviewController');

    // Recommendation
    Route::delete('recommendations/destroy', 'RecommendationController@massDestroy')->name('recommendations.massDestroy');
    Route::post('recommendations/media', 'RecommendationController@storeMedia')->name('recommendations.storeMedia');
    Route::post('recommendations/ckmedia', 'RecommendationController@storeCKEditorImages')->name('recommendations.storeCKEditorImages');
    Route::resource('recommendations', 'RecommendationController');

    // Brand
    Route::delete('brands/destroy', 'BrandController@massDestroy')->name('brands.massDestroy');
    Route::post('brands/media', 'BrandController@storeMedia')->name('brands.storeMedia');
    Route::post('brands/ckmedia', 'BrandController@storeCKEditorImages')->name('brands.storeCKEditorImages');
    Route::resource('brands', 'BrandController');

    // Order Ticket
    Route::delete('order-tickets/destroy', 'OrderTicketController@massDestroy')->name('order-tickets.massDestroy');
    Route::post('order-tickets/media', 'OrderTicketController@storeMedia')->name('order-tickets.storeMedia');
    Route::post('order-tickets/ckmedia', 'OrderTicketController@storeCKEditorImages')->name('order-tickets.storeCKEditorImages');
    Route::resource('order-tickets', 'OrderTicketController');

    // Event
    Route::delete('events/destroy', 'EventController@massDestroy')->name('events.massDestroy');
    Route::post('events/media', 'EventController@storeMedia')->name('events.storeMedia');
    Route::post('events/ckmedia', 'EventController@storeCKEditorImages')->name('events.storeCKEditorImages');
    Route::resource('events', 'EventController');

    // Barang
    Route::delete('barangs/destroy', 'BarangController@massDestroy')->name('barangs.massDestroy');
    Route::post('barangs/media', 'BarangController@storeMedia')->name('barangs.storeMedia');
    Route::post('barangs/ckmedia', 'BarangController@storeCKEditorImages')->name('barangs.storeCKEditorImages');
    Route::resource('barangs', 'BarangController');

    // Submission Link
    Route::delete('submission-links/destroy', 'SubmissionLinkController@massDestroy')->name('submission-links.massDestroy');
    Route::resource('submission-links', 'SubmissionLinkController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
