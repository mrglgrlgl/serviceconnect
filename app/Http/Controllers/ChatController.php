<?php
namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Channel;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function getChats(Request $request)
    {
        $channelId = $request->query('channel_id');
        $channel = Channel::findOrFail($channelId);

        // Authorization check
        if (!$this->isUserAuthorized($channel)) {
            abort(403, 'Unauthorized access to this channel.');
        }

        $chats = $channel->chats()->orderBy('created_at')->get();

        return response()->json($chats);
    }

    public function sendChat(Request $request)
    {
        $channelId = $request->input('channel_id');
        $channel = Channel::findOrFail($channelId);
    
        // Authorization check
        if (!$this->isUserAuthorized($channel)) {
            abort(403, 'Unauthorized to send messages to this channel.');
        }
    
        $chat = Chat::create([
            'channel_id' => $channelId,
            'sender_id' => Auth::id(),
            'sender_name' => Auth::user()->name,
            'message_text' => $request->input('message_text'),
        ]);
    
        broadcast(new MessageSent($chat->sender_name, $chat->message_text, $channelId));
    
        return response()->json(['status' => 'Message Sent!']);
    }
    

    private function isUserAuthorized(Channel $channel)
    {
        $userId = Auth::id();
        return $channel->seeker_id === $userId || $channel->provider_id === $userId;
    }

    // Controller method that loads the chat view
public function showChat(Channel $channel)
{
    return view('chatbox', ['channelId' => $channel->id]);
}

}
