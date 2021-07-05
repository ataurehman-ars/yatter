<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('newcomment.{postId}', function () {
    return Auth::check();
});


Broadcast::channel('connectionactive.{connection_id}', function () {
    return Auth::check();
});


Broadcast::channel('connectionoffline.{authId}', function () {
    return Auth::check();
});

Broadcast::channel('newmessageto.{receiver_id}', function ($receiver_id) {
    return Auth::check();
});

Broadcast::channel('updatesenderchat.{auth_id}', function () {
    return Auth::check();
});

Broadcast::channel('messageseen.{sender_id}.{receiver_id}', function () {
    return Auth::check();
});

Broadcast::channel('typing-{sender_id}.{receiver_id}', function () {
    return Auth::check();
});

Broadcast::channel('seen-{sender_id}.{receiver_id}', function () {
    return Auth::check();
});



