<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Input;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Carbon\Carbon;
use DB;
use Response;

class MessageController extends Controller
{
    //
    public function newMessage()
    {
        $users = \App\User::where('id', '!=', Auth::id())->get();

        return view('messages.create', ['page' => 'message', 'users' => $users]);
    }

    public function sendMessage()
    {

        $input = Input::all();
        $thread = Thread::create(
            [
                'subject' => $input['subject'],
            ]
        );
        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'body'      => $input['message'],
            ]
        );
        // Sender
        Participant::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'last_read' => new Carbon,
            ]
        );
        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipants($input['recipients']);
        }
        return redirect('messages.create');

        return view('messages.create', ['page' => 'message', 'users' => $users]);
    }

    public function getUsers(){
    	$term = Input::get('term');

    	$results = array();

    	$queries = DB::table('users')
    		->where('email', 'LIKE', '%'.$term.'%')
    		->take(5)->get();

    	foreach ($queries as $query)
    	{
    	    $results[] = [ 'id' => $query->id, 'value' => $query->email ];
    	}
        return Response::json($results);
    }
}
