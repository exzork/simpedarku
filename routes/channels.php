<?php

use Illuminate\Support\Facades\Broadcast;

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

Broadcast::channel('newReport.{typeId}', function ($user, $typeId) {
    $user = auth()->user();
    if($user->is_stakeholder || $user->is_admin) {
        if($user->is_admin){
            return true;
        }else{
            return $user->stakeholder->type_id == $typeId;
        }
    }
    return false;
});
