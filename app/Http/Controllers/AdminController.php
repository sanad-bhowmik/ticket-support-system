<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch all tickets from the database
        $tickets = Ticket::all(); // You can adjust this to add filters, pagination, etc.

        // Return the view and pass the tickets data
        return view('components.userTickets', compact('tickets'));
    }
    public function updateTicket(Request $request, $ticketId)
    {
        // Validate the input
        $request->validate([
            'subject' => 'required|string|max:255',
            'status' => 'required|string|in:Open,In Progress,Resolved,Closed',
        ]);

        // Find the ticket by ID
        $ticket = Ticket::findOrFail($ticketId);

        // Update the ticket with new data
        $ticket->update([
            'subject' => $request->subject,
            'status' => $request->status,
        ]);

        // Redirect back with success message
        return redirect()->route('admin.tickets')->with('success', 'Ticket updated successfully!');
    }
}
