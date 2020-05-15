<?php
use SebastianHalas\Likes\Models\Likes;
use SebastianHalas\Posts\Models\Posts;
Route::group(['prefix' => 'api/v1/likes'], function() {
    Route::post('vote_yes/{post_id}', function ($post_id) {
        
        $token = request()->input('token');
        $userModel = JWTAuth::toUser($token);
        $userID = $userModel->id;
        
        $like = new Likes;
        $like->user_id = $userID;
        $like->posts_id = $post_id;
        $like->like_value = 1;
        $like->save();
        
        return;
    });
    Route::post('vote_no/{post_id}', function ($post_id) {
        
        $token = request()->input('token');
        $userModel = JWTAuth::toUser($token);
        $userID = $userModel->id;
        
        $like = new Likes;
        $like->user_id = $userID;
        $like->posts_id = $post_id;
        $like->like_value = 0;
        $like->save();
        
        return;
    });
    Route::post('remove_vote/{post_id}', function ($post_id) {
        
        $token = request()->input('token');
        $userModel = JWTAuth::toUser($token);
        $userID = $userModel->id;

        $like = Likes::where('user_id',$userID)
                        ->where('posts_id',$post_id)
                        ->take(1);
        $like->delete();
        
        return;
    });
    
});