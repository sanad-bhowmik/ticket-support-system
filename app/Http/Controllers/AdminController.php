<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();

        return view('components.userTickets', compact('tickets'));
    }
    public function updateTicket(Request $request, $ticketId)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'status' => 'required|string|in:Open,In Progress,Resolved,Closed',
        ]);

        $ticket = Ticket::findOrFail($ticketId);

        $ticket->update([
            'subject' => $request->subject,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.tickets')->with('success', 'Ticket updated successfully!');
    }
}
