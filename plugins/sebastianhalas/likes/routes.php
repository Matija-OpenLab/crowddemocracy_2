<?php
use SebastianHalas\Likes\Models\Likes;
Route::group(['prefix' => 'api/v1/likes'], function() {
    Route::get('like/{uid}/{lid}', function ($uid,$lid) {
        $like = new Likes;
        $like->user_id = $uid;
        $like->likeable_id = $lid;
        $like->save();
        return;
    });
    Route::get('unlike/{uid}/{lid}', function ($uid,$lid) {
        $like = Likes::where('user_id',$uid)
                        ->where('likeable_id',$lid)
                        ->take(1);
        $like->delete();
    });
});