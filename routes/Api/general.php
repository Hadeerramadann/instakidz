
<?php
use Illuminate\Support\Facades\Route;
Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
})->name('login');
Route::group([ 'namespace' => 'Api\general'], function () {


     Route::post('login', 'LoginController@login');
     Route::prefix('/general')->group(function () {
        Route::get('/attendance/report', 'AttendanceController@getAttendanceReport');
        Route::get('/attendance/class/{class_id}', 'AttendanceController@getClassAttendance');
     });
});
