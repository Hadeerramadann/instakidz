
<?php
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/admin','namespace' => 'Api\admin'], function () {

    Route::prefix('/student')->group(function () {
            Route::post('/add', 'StudentController@AddStudent');
            Route::get('/list', 'StudentController@list');
    });
  

   
});

