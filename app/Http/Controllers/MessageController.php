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
use Log;

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
        if (Input::has('users')) {
            $users = $input['users'];
            $recipients = explode(',',$users);
            $thread->addParticipants($recipients);
        }
        //return redirect('messages.create');

        return view('messages.create', ['page' => 'message', 'users' => $users]);
    }

    public function getUsers(){
    	$term = Input::get('searchText');

    	$results = array();

        Log::info('searching for users with emails like ' . $term);
    	$queries = DB::table('users')
    		->where('email', 'LIKE', '%'.$term.'%')
    		->take(5)->get();

    	foreach ($queries as $query)
    	{
    	    $results[] = [ 'id' => $query->id, 'value' => $query->email ];
    	}
        return Response::json($results);
    }

    public function getThreads()
    {
        $currentUserId = Auth::user()->id;
        // All threads, ignore deleted/archived participants
        //$threads = Thread::getAllLatest()->get();
        
        // All threads that user is participating in
         $threads = Thread::forUser($currentUserId)->latest('updated_at')->get();
        // All threads that user is participating in, with new messages
        // $threads = Thread::forUserWithNewMessages($currentUserId)->latest('updated_at')->get();

        return view('messages.index', ['page' => 'message', 'threads' => $threads, 'currentUserId' => $currentUserId]);
    }
}
