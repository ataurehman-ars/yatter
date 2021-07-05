<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use DB;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $create = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'username' => $input['username'] ,
            'password' => Hash::make($input['password']),
        ]);


        if ($create){

            $get_id = DB::table('users')->where('username' , $input['username'])->select('id')->get();
            $this->createMessageTable($get_id);
            return $create;
        }

    }


    public function createMessageTable($id)
    {

        Schema::connection('mysql')->create('messages_' . $id[0]->id , function(Blueprint $table)
        {
            $table->id();
            $table->integer('sent_from');
            $table->integer('sent_to');
            $table->text('message');
            $table->string('created_at');
        });

        return;
    }
}



