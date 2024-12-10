<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function show($sport)
    {
        $user = Auth::user();
        $userSports = $user->sport_interest ?? [];
        
        // Check if user is part of this sport group
        if (!in_array($sport, $userSports)) {
            return redirect()->route('dashboard')
                ->with('error', 'You must join this sport group to access its chat.');
        }

        // Get or create chat room for this sport
        $chatRoom = ChatRoom::firstOrCreate(
            ['sport' => $sport],
            [
                'name' => "$sport Group Chat",
                'description' => "Welcome to the $sport group chat! Connect with other players, arrange matches, and share your passion for $sport."
            ]
        );

        $messages = $chatRoom->messages()
            ->orderBy('created_at', 'desc')
            ->paginate(50);
        
        return view('chat.show', [
            'chatRoom' => $chatRoom,
            'messages' => $messages,
            'sport' => $sport
        ]);
    }

    public function sendMessage(Request $request, $sport)
    {
        $user = Auth::user();
        if (!in_array($sport, $user->sport_interest ?? [])) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'content' => 'required|string|max:1000',
            'reply_to_id' => 'nullable|exists:messages,id'
        ]);

        $chatRoom = ChatRoom::where('sport', $sport)->firstOrFail();

        $message = $chatRoom->messages()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
            'reply_to_id' => $request->reply_to_id
        ]);

        return response()->json($message->load(['user', 'replyTo.user']));
    }

    public function deleteMessage(Message $message)
    {
        if ($message->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $message->delete();
        return response()->json(['message' => 'Message deleted successfully']);
    }
}
