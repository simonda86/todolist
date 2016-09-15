<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

    public $hidden = [
        'completed_at',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

}
