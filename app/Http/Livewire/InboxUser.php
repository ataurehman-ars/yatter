<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Messages;

use DB;
use Crypt;
use Auth;

class InboxUser extends Component
{

    public $auth_id;
    public $collector;
    public $recents;
    public $connections;

    public function mount()
    {
        $this->auth_id = Auth::id();
        $this->collector = [];
        $this->recents = [];
        $this->recent_messages();
        //$this->listRecents();
    }

    public function getListeners()
    {
        return [
            "refresh-inbox" => "listRecents" , 
            "decrypt-msg" => "decryptMsg" , 
        ];
    }

    public function render()
    {
        return view('livewire.inbox-user');
    }

   

    public function listRecents()
    {
        $this->recents = DB::table('messages_' . $this->auth_id)
        ->where('sent_to' , $this->auth_id)
        ->orWhere('sent_from' , $this->auth_id)
        ->select('id' , 'sent_to' , 'sent_from' , 'message')
        ->orderBy('created_at' , 'desc')
        ->get();

        foreach($this->recents as $recent){

            $sent_from_own = $recent->sent_from === $this->auth_id;
            $sender_id = $sent_from_own ? $recent->sent_to : $recent->sent_from;
            $message = $recent->message;

            if(count($this->collector) && array_key_exists($sender_id, $this->collector))
                continue;
            

            $push_new = DB::table('users')
            ->where('id' , $sender_id)
            ->select('id' , 'username' , 'name', 'profile_photo_path')
            ->get();

            $to_arr = (array)$push_new[0];
            $to_arr['msg'] = $message;
            $to_arr['sent_from_own'] = $sent_from_own;

            $this->collector[$sender_id] = (object)$to_arr;
        }


    
    }


    public function test()
    {
        $table_name = 'messages_' . $this->auth_id;

        $distints = DB::table($table_name)
        ->select(DB::raw("DISTINCT sent_from, sent_to"))
        ->limit(10)
        ->get();

        $filter = [];

        foreach($distints as $distinct){
            if ($distinct->sent_from === $this->auth_id && 
            !in_array($distinct->sent_to, $filter)){
                array_push($filter, $distinct->sent_to);
            }
            else if($distinct->sent_from !== $this->auth_id){
                array_push($filter, $distinct->sent_from);
            }
        }
        
        print_r($filter);
        echo "<br><br>";

        $collect_all = [];

        foreach($filter as $id){

            $message = DB::table($table_name)
            ->where('sent_from' , $id)
            ->orWhere(function($query) use ($id){
                $query->where('sent_to' , $id);
            })
            ->leftjoin('users' , function($join) use ($id){
                $join->where('users.id' , '=' , $id)
                ->orWhere('users.id' , '=' , $id);
            })
            ->select($table_name . '.message' , $table_name . '.created_at', 
            'users.username' , 'users.profile_photo_path')
            ->orderBy($table_name . '.created_at' , 'desc')
            ->limit(1)
            ->get();

            $collect_all[$id] = $message[0];
            

        }

        

    }


    public function recent_messages()
    {
        $sp = DB::select("call recent_messages(?)" , [ $this->auth_id ]);

        var_dump($sp);

    }
}





