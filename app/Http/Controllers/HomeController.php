<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    /**
     * @return mixed
     */
    public function index()
    {
        return view('home');
    }

    public function report()
    {
        $events = Event::all();
        return view('reports.navidad',compact('events'));
    }
}
