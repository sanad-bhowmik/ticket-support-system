<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function sendMessage(Request $request, $ticket_id)
    {
        $ticket = Ticket::findOrFail($ticket_id);

        $message = Message::create([
            'ticket_id' => $ticket_id,
            'user_id' => auth()->id(), // assuming you're using authentication
            'message' => $request->message,
            'status' => 'sent', // or any status you need
        ]);

        // Broadcast the message
        broadcast(new MessageSent($message->message, $ticket_id, auth()->user()));

        // Return a response (could be JSON, or you can redirect)
        return response()->json(['status' => 'Message sent successfully!']);
    }

    public function viewMessages($ticket_id)
    {
        $ticket = Ticket::findOrFail($ticket_id);
        $messages = Message::where('ticket_id', $ticket_id)->orderBy('created_at', 'asc')->get();
        return view('components.message', compact('ticket', 'messages'));
    }

    public function index()
    {
        $tickets = \App\Models\Ticket::all();

        return view('components.userMessage', compact('tickets'));
    }

    public function showChat($ticket_id)
    {
        $ticket = Ticket::findOrFail($ticket_id);

        $messages = Message::where('ticket_id', $ticket_id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('components.chat', compact('ticket', 'messages'));
    }
}
