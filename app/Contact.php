<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'first',
        'last',
        'position',
        'account',
        'identification',
        'email',
        'navidad',
        'navidad2',
        'navidad3',
        'navidad4',
        'bd_dotacion',
        'bd_navidad',
        'dotacion1'
    ];

    public function lastEvent()
    {
        $event = Event::where('email',$this->email)->orderBy('created_at','desc')->limit(1)->get();
//        dd($event);
        return $event;
    }

}
