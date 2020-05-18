<?php namespace SebastianHalas\Communities\Models;

use Model;

/**
 * Model
 */
class Communities extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'sebastianhalas_communities_main';

    /**
     * @var array Validation rules
     */
    public $belongsToMany = [
        'users' => ['RainLab\User\Models\User', 'table' => 'sebastianhalas_communities_join']
    ];

    public $rules = [
    ];
}
