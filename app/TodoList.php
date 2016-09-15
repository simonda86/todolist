<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TodoList extends Model {

    use SoftDeletes;

    public $hidden = [
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $table = 'lists';
}
