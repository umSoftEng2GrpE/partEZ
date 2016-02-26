<?php
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('invite_response', function(){
    return view('inviteresponse');
});

Route::post('event_guest/{id}', ['as' => 'events.event_details', 'uses' => 'EventController@details']);

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
Route::get('profile', [
    'middleware' => 'auth',
    'uses' => 'ProfileController@show'
]);

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/', 'WelcomeController@index');
    Route::get('/home', 'HomeController@index');
    Route::get('/sendtest', 'Email\EmailController@sendTestEmail');
    Route::get('create_event', 'EventController@index');
    Route::get('accept_invite/{eid}/{uid}', ['as' => 'accept_invite', 'uses' => 'EventController@inviteAccept']);
    Route::get('decline_invite/{eid}/{uid}', ['as' => 'decline_invite', 'uses' => 'EventController@inviteDecline']);
    Route::get('event/{id}', ['as' => 'events.event_details', 'uses' => 'EventController@details']);
    Route::get('invite/{id}', ['as' => 'events.event_details_invite', 'uses' => 'EventController@inviteDetails']);
    
    Route::post('create_event', 'EventController@store');
    Route::post('event/{id}', ['as' => 'events.event_details', 'uses' => 'EventController@details']);
    Route::post('invite_event', 'EventController@splitEmails');
    Route::post('send_invites', 'EventController@inviteUsers');
    Route::post('invite/{id}', ['as' => 'events.event_details_invite', 'uses' => 'EventController@inviteDetails']);
    Route::post('polls/{polls}', ['as' => 'polls.poll_options', 'uses' => 'EventController@details']);
    Route::post('create_poll', 'EventController@validatePoll');
    Route::post('submit_poll', 'EventController@submitPoll');

    Route::post('details_chat','MessageController@saveNewMessageDetails');
    Route::post('invite_chat','MessageController@saveNewMessageInvite');


});

Route::group(['prefix' => 'api'], function()
{
    Route::resource('authenticate', 'ApiControllers\Auth\AuthenticateController', ['only' => ['index']]);
    Route::post('authenticate', 'ApiControllers\Auth\AuthenticateController@authenticate');
    Route::post('register', 'ApiControllers\Auth\AuthenticateController@register');

    Route::resource('api_welcome', 'ApiControllers\Views\ApiWelcomeController', ['only' => ['index']]);
    Route::resource('api_home', 'ApiControllers\Views\ApiHomeController', ['only' => ['index']]);
});

/*Route::get('create_event_restful', 'EventController@indexRestful');
Route::post('/register_restful', function () {
    $credentials = Input::only('email', 'password');

    try {
        $user = User::create($credentials);
    } catch (Exception $e) {
        return Response::json(['error' => 'User already exists.'], HttpResponse::HTTP_CONFLICT);
    }

    $token = JWTAuth::fromUser($user);

    return Response::json(compact('token'));
});
Route::post('/login_restful', function () {
    $credentials = Input::only('email', 'password');

    if ( ! $token = JWTAuth::attempt($credentials)) {
        return Response::json(false, HttpResponse::HTTP_UNAUTHORIZED);
    }

    return Response::json(compact('token'));
});
//Example of verification
Route::get('/restricted', [
    'before' => 'jwt-auth',
    function () {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        return Response::json([
            'data' => [
                'email' => $user->email,
                'registered_at' => $user->created_at->toDateTimeString()
            ]
        ]);
    }
]);*/


