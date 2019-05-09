<?php
Route::group(['middleware' => ['web']], function () {
    Route::get("about", "Hosein\Aboutus\Controllers\AboutController@index");
    Route::post("createAbout", "Hosein\Aboutus\Controllers\AboutController@createAbout");
    Route::post("updateAbout/{id}", "Hosein\Aboutus\Controllers\AboutController@updateAbout");

    Route::get("editPerson/{id}", "Hosein\Aboutus\Controllers\AboutController@editPerson");
    Route::post("createPerson", "Hosein\Aboutus\Controllers\AboutController@createPerson");
    Route::post("updatePerson/{id}", "Hosein\Aboutus\Controllers\AboutController@updatePerson");

});
