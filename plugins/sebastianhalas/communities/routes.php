<?php
use SebastianHalas\Communities\Models\Communities;
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
Route::group(['prefix' => 'api/v1/communities'], function() {
    
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

        if(!$userModel->is_activated == true){
            return "Unauthorized.";
        }
        if(isset($name) && isset($description)){
            $community = new Communities;
            $community->name = $name;
            $community->description = $description;
            $community->owner = $userModel->name;
            $community->user_count = 0;
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

        if(!$userModel->is_activated == true){
            return "Unauthorized.";
        }
        if(isset($id)){
            $community = Communities::where('id',$id)->first();
            $community->delete();
            return "Deleted successfully.";
        }
        else {
            return "Error.";
        }
    });
});
