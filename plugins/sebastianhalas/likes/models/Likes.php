<?php namespace SebastianHalas\Likes\Models;

use Model;

/**
 * Model
 */
class Likes extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'sebastianhalas_likes_likeables';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
