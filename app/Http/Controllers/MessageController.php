<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Get all messages
    public function index()
    {
        return response()->json(Message::all());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $request, 
            [
                'message' => 'required|string|max:255',
                'receiver' => 'required|int|max:10',
                'sender' => 'required|int|max:10',
            ],
            [
                'error_code' => 422,
                'error_title' => 'Message send failure',
                'error_message' => 'The :attribute field is required.'           
            ]);
    }


    public function get_user_messages(Request $request, $user_id1, $user_id2)
    {
        $user_messages = DB::table('messages')
            ->whereIn('sender', [$user_id1, $user_id2])
            ->whereIn('receiver', [$user_id1, $user_id2])
            ->orderBy('created_at', 'ASC')
            ->get();

        return response()->json(['user_messages' => $user_messages]);

    }

    /**
     * Create a new message
     *
     * @param  object  $request
     * @return json
     */   
     public function store(Request $request)
    {
        $message = Message::create([
            'message' => $request->message,
            'receiver' => $request->receiver_user_id,
            'sender' => $request->sender_user_id,
        ]);

        return response()->json(['success_code' => 201,
        'success_title' => 'Message',
        'success_message' => 'Message sent successfully'
        ]);
    }

    // Get a single message
    public function show($message_id)
    {
        return response()->json(Message::findOrFail($message_id));
    }

    /**
     * Update a single message.
     * Update only the message content
     * @param  object  $request
     * @param int $message_id - message identifier
     * @return json
     */       
    public function update(Request $request, $message_id)
    {
        $message = Message::findOrFail($message_id);
        $message->update($request->only(['message']));

        return response()->json($message);
    }

    // Delete a message
    public function destroy($message_id)
    {
        Message::findOrFail($message_id)->delete();
        return response()->json(['message' => 'Chat message deleted successfully']);
    }

    public function attributes()
    {
        return[
            'receiver_user_id' => 'receiver', 
            'sender_user_id' => 'sender',
        ];
    
    }
}
