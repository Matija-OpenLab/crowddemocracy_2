<?php 
use SebastianHalas\Posts\Models\Posts;
Route::group(['prefix' => 'api/v1/posts'], function() {
    
    Route::get('', function () {
        $posts = Posts::all();

        return $posts;
    });

    Route::get('/{id}', function ($id) {
        $like_sum = 0;
        $posts = Posts::where('id',$id)->take(1)->get();
        $likes = Posts::find($id)->likes;
        
        foreach ($likes as $like) {
            $like_sum++;
        }

        return response()->json(compact('like_sum','posts'));
    });

    Route::get('/community_id/{id}', function ($id) {
        $posts = Posts::where('community_id',$id)->get();
        
        return $posts;
    });
});