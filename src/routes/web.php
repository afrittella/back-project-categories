<?php
Route::group(['namespace' => 'Afrittella\BackProjectCategories\Http\Controllers'], function () {
    Route::group(['middleware' => 'web', 'prefix' => config('back-project.route_prefix')], function () {
        Route::get('categories/{menu}/up', 'CategoriesController@up')->name('bp.categories.up');
        Route::get('categories/{menu}/down', 'CategoriesController@down')->name('bp.categories.down');
        Route::get('categories/{category}/delete', 'CategoriesController@delete')->name('bp.categories.delete'); // Implementing delete avoiding DELETE method
        Route::post('categories/{category}/add-image', 'CategoriesController@addImage')->name('bp.categories.add-image');
        Route::resource('categories', 'CategoriesController', ['except' => ['destroy'], 'as' => 'bp']);
    });
});