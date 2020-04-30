<?php 
use SebastianHalas\Posts\Models\Posts;
Route::group(['prefix' => 'api/v1/posts'], function() {
    
    Route::get('', function () {
        $posts = Posts::all();
        return $posts;
    });

    Route::get('/{id}', function ($id) {
        $posts = Posts::where('id',$id)->take(1)->get();
        return $posts;
    });

    Route::get('/community_id/{id}', function ($id) {
        $posts = Posts::where('community_id',$id)->get();
        return $posts;
    });
});