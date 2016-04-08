<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiControllers\Views\ApiHomeController;
use App\Invite;
use Auth;
use DB;
use Mail;
use App\Event;
use App\Http\Requests;
use Illuminate\Support\Facades\Request;

class HomeController extends ApiHomeController
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($local_events_only = false)
    {
        $response =  ApiHomeController::index();
        return view('home')->with('data', $response->getData());
    }

}
