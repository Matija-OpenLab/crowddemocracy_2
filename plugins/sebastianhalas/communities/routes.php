<?php
use SebastianHalas\Communities\Models\Communities;
Route::get('api/v1/communities', function () {
    $communities = Communities::all();
    return $communities;
});
Route::get('api/v1/communities/{id}', function ($id) {
    $communities = Communities::where('id',$id)->take(1)->get();
    return $communities;
});
/*Route::group(['prefix' => 'api/v1'], function () {
    Route::resource('communities', 'SebastianHalas\Communities\Controllers\Communities');
});*/