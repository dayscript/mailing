<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    protected $fillable = [
        'title',
        'subject',
        'image',
        'url'
    ];
}
