<?php

namespace App\Actions\Jetstream;

use Laravel\Jetstream\Contracts\DeletesUsers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Auth;

class DeleteUser implements DeletesUsers
{
    
    public function delete($user)
    {   
        $collect_id = Auth::id();

        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user_deleted = $user->delete();


        if ($user_deleted){
            Schema::dropIfExists('messages_' . $collect_id);
            Schema::dropIfExists('connections_' . $collect_id);
            return;
        }
    }
}



