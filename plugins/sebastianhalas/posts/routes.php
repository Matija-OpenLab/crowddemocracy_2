<?php 
use SebastianHalas\Posts\Models\Posts;
Route::get('api/v1/posts', function () {
    $posts = Posts::all();
    return $posts;
});
Route::get('api/v1/posts/{id}', function ($id) {
    $posts = Posts::where('id',$id)->take(1)->get();
    return $posts;
});
Route::get('api/v1/posts/community_id/{id}', function ($id) {
    $posts = Posts::where('community_id',$id)->get();
    return $posts;
});