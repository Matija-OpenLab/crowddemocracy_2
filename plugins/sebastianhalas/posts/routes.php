<?php 
use SebastianHalas\Posts\Models\Posts;
function db_update()
{
    $posts = Posts::all();
        foreach ($posts as $post) {
            $id = $post->id;
            $likes = Posts::find($id)->likes->where('like_value',1)->count();
            $dislikes = Posts::find($id)->likes->where('like_value',0)->count();
            $total_votes = $likes + $dislikes;
            $post->vote_yes = $likes;
            $post->vote_no = $dislikes;
            $post->total_votes = $total_votes;
            $post->save();
        }
}
Route::group(['prefix' => 'api/v1/posts'], function() {
    
    Route::get('', function () {
        db_update();
        
        $posts = Posts::all();

        return $posts;
    });

    Route::get('/{id}', function ($id) {    
        db_update();
        
        $post = Posts::where('id',$id)->take(1)->get();      
       
        return response()->json(compact('likes','dislikes','total_votes','post'));
    });
    
    Route::get('/community_id/{id}', function ($id) {
        db_update();
     
        $posts = Posts::where('community_id',$id)->get();
        
        return response()->json(compact('posts'));
        
    });

    Route::post('/create', function () {
       
        $token = request()->input('token');
        $userModel = JWTAuth::toUser($token);
        
        $content =  request()->input('content');
        $communityid = request()->input('community_id');
        
        if(!$userModel->is_activated == true){
            return "Unauthorized.";
        }
        
        if(isset($content) && isset($communityid)){
            $post = new Posts;
            $post->content = $content;
            $post->community_id = $communityid;
            $post->save();
            return "Creation successful.";
        }
        
        else {
            return "Error.";
        }
        
    });
});