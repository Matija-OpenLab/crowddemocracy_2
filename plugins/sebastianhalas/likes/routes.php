<?php
use SebastianHalas\Likes\Models\Likes;
use SebastianHalas\Posts\Models\Posts;
Route::group(['prefix' => 'api/v1/likes', 'middleware' => '\Tymon\JWTAuth\Middleware\GetUserFromToken'], function() {
    Route::post('vote_yes/{post_id}', function ($post_id) {
        
        $token = request()->input('token');
        $userModel = JWTAuth::toUser($token);
        $userID = $userModel->id;
        
        $post = Posts::where('id',$post_id)->first();

        if($post->is_finished == true){
            return "Couldn't vote, because voting is already finished.";
        }
        
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
        
        $post = Posts::where('id',$post_id)->first();
        
        if($post->is_finished == true){
            return "Couldn't vote, because voting is already finished.";
        }

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

        $post = Posts::where('id',$post_id)->first();
        
        if($post->is_finished == true){
            return "Couldn't change vote, because voting is already finished.";
        }

        $like = Likes::where('user_id',$userID)
                        ->where('posts_id',$post_id)
                        ->take(1);
        $like->delete();
        
        return;
    });
    
});