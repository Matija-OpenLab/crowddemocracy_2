<?php
use SebastianHalas\Communities\Models\Communities;
Route::group(['prefix' => 'api/v1/communities'], function() {
    
    Route::get('', function () {
        $communities = Communities::all();
        return $communities;
    });

    Route::get('/{id}', function ($id) {
        $communities = Communities::where('id',$id)->take(1)->get();
        return $communities;
    });

});
