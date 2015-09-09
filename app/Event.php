<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {

    protected $fillable = [
        'sg_message_id',
        'email',
        'time',
        'category',
        'event',
        'url',
        'asm_group_id',
        'smtp-id',
        'useragent',
        'ip',
        'status',
        'reason',
        'type',
        'attempt',
        'response'
    ];
}
