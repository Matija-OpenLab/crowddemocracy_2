<?php
use SebastianHalas\Communities\Models\Communities;
use SebastianHalas\Posts\Models\Posts;
use RainLab\User\Models\User;
use RainLab\User\Models\UserGroup;
function db_update_communities()
{
    $communities = Communities::all();
        foreach ($communities as $community) {
            $userCount = $community->users->count();
            $community->user_count = $userCount;
            $community->save();
        }
}
Route::group(['prefix' => 'api/v1/communities', 'middleware' => '\Tymon\JWTAuth\Middleware\GetUserFromToken'], function() {
    
    Route::get('', function () {
        
        db_update_communities();

        $communities = Communities::all();
        return $communities;
    });

    Route::get('/{id}', function ($id) {
        
        db_update_communities();

        $communities = Communities::where('id',$id)->take(1)->get();
        return $communities;
    });

    Route::post('/join/{id}',function($id){

        $token = request()->input('token');
        $userModel = JWTAuth::toUser($token);

        $userModel->community()->attach($id);

    });

    Route::post('/leave/{id}',function($id){
        
        $token = request()->input('token');
        $userModel = JWTAuth::toUser($token);

        $userModel->community()->detach($id);

    });

    Route::post('/create', function () {
        
        $token = request()->input('token');
        $userModel = JWTAuth::toUser($token);
        
        $name =  request()->input('name');
        $description =  request()->input('description');

        if($userModel->is_activated == false){
            return "Unauthorized.";
        }
        if(isset($name) && isset($description)){
            $community = new Communities;
            $community->name = $name;
            $community->description = $description;
            $community->owner = $userModel->name;
            $community->user_count = 0;
            $community->icon_id = rand(0,3);
            $community->save();
            return "Creation successful.";
        }
        else {
            return "Error.";
        }
        
    });

    Route::post('/remove', function () {
        $token = request()->input('token');
        $userModel = JWTAuth::toUser($token);
        
        $id =  request()->input('id');

        if($userModel->is_activated == false){
            return "Unauthorized.";
        }
        if(isset($id)){
            Posts::where('community_id',$id)->delete();
            $community = Communities::where('id',$id)->first();
            $community->delete();
            return "Deleted successfully.";
        }
        else {
            return "Error.";
        }
    });

    Route::post('/edit', function () {
        $token = request()->input('token');
        $userModel = JWTAuth::toUser($token);
        
        $id = request()->input('id');
        $name =  request()->input('name');
        $description =  request()->input('description');

        if($userModel->is_activated == false){
            return "Unauthorized.";
        }
        if(isset($name) && isset($description) && isset($id)){
            $community = Communities::where('id',$id)->first();
            if(is_null($community)){
                return "Community doesn't exist.";
            }
            else {
                $community->name = $name;
                $community->description = $description;
                $community->save();
                return "Edited successfully.";
            }
        }
        else {
            return "Error.";
        }
    });
   
});
