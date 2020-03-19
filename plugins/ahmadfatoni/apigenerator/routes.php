<?php
use SebastianHalas\Communities\Models\Communities;
Route::post('fatoni/generate/api', array('as' => 'fatoni.generate.api', 'uses' => 'AhmadFatoni\ApiGenerator\Controllers\ApiGeneratorController@generateApi'));
Route::post('fatoni/update/api/{id}', array('as' => 'fatoni.update.api', 'uses' => 'AhmadFatoni\ApiGenerator\Controllers\ApiGeneratorController@updateApi'));
Route::get('fatoni/delete/api/{id}', array('as' => 'fatoni.delete.api', 'uses' => 'AhmadFatoni\ApiGenerator\Controllers\ApiGeneratorController@deleteApi'));

Route::resource('api/communities/', 'AhmadFatoni\ApiGenerator\Controllers\API\communitiesController', ['except' => ['destroy', 'create', 'edit']]);
Route::get('api/communities//{id}/show', ['as' => 'api/communities/.show', 'uses' => 'AhmadFatoni\ApiGenerator\Controllers\API\communitiesController@show']);
//Route::get('api/communities//{id}/delete', ['as' => 'api/communities/.delete', 'uses' => 'AhmadFatoni\ApiGenerator\Controllers\API\communitiesController@destroy']);