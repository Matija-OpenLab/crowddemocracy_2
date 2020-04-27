<?php
use SebastianHalas\Likes\Models\Likes;
use SebastianHalas\Posts\Models\Posts;
Route::group(['prefix' => 'api/v1/likes'], function() {
    Route::get('like/{uid}/{lid}', function ($uid,$lid) {
        $like = new Likes;
        $like->user_id = $uid;
        $like->likeable_id = $lid;
        $like->like_value = 1;
        $like->save();
        $post = Posts::where('id',$lid)
                        ->first();
        $post->vote_yes =$post->vote_yes + 1;
        $post->save();
        return;
    });
    Route::get('unlike/{uid}/{lid}', function ($uid,$lid) {
        $like = new Likes;
        $like->user_id = $uid;
        $like->likeable_id = $lid;
        $like->like_value = 0;
        $like->save();
        $post = Posts::where('id',$lid)
                        ->first();
        $post->vote_no =$post->vote_no + 1;
        $post->save();
        return;
    });
    Route::get('remove_like/{uid}/{lid}', function ($uid,$lid) {
        $like = Likes::where('user_id',$uid)
                        ->where('likeable_id',$lid)
                        ->take(1);
        $like->delete();
        $post = Posts::where('id',$lid)
                        ->first();
        $post->vote_yes =$post->vote_yes - 1;
        $post->save();
        return;
    });
    Route::get('remove_unlike/{uid}/{lid}', function ($uid,$lid) {
        $like = Likes::where('user_id',$uid)
                        ->where('likeable_id',$lid)
                        ->take(1);
        $like->delete();
        $post = Posts::where('id',$lid)
                        ->first();
        $post->vote_no = $post->vote_no - 1;
        $post->save();
        return;
    });
});