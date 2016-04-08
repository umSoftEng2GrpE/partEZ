<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiControllers\Views\ApiWelcomeController;
use App\Http\Requests;
use App\Event;


class WelcomeController extends ApiWelcomeController
{
    /**
     * Show the applications welcome page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response =  ApiWelcomeController::index();
        return view('welcome')->with('data', $response->getData());
    }
}
