<?php
use SebastianHalas\Communities\Models\Communities;
use RainLab\User\Models\User;
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

    Route::get('/join/{id}',function($id){

        $token = request()->input('token');
        $userModel = JWTAuth::toUser($token);

        $userModel->community()->attach($id);

    });

    Route::get('/leave/{id}',function($id){
        
        $token = request()->input('token');
        $userModel = JWTAuth::toUser($token);

        $userModel->community()->detach($id);

    });

});
