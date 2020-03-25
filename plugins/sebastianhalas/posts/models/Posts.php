<?php namespace SebastianHalas\Posts\Models;

use Model;

/**
 * Model
 */
class Posts extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'sebastianhalas_posts_';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
