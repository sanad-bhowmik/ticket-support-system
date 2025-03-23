<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    public function index()
    {
        // Fetch all tickets from the database
        $tickets = Ticket::all();

        // Pass the tickets to the view
        return view('components.ticket', compact('tickets'));
    }
    public function store(Request $request)
    {
        // Validate the data
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'priority' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,png,pdf,docx|max:2048',
        ]);

        // Handle file upload if there's an attachment
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('tickets', 'public');
        }

        // Create the ticket
        Ticket::create([
            'subject' => $validated['subject'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'priority' => $validated['priority'],
            'file_path' => $path ?? null,
        ]);

        // Redirect with success message
        return redirect()->route('tickets')->with('success', 'Ticket created successfully!');
    }
    public function destroy($id)
    {
        // Find the ticket by its ID
        $ticket = Ticket::findOrFail($id);

        // If there's an associated file, delete it
        if ($ticket->file_path) {
            // Assuming the files are stored in the 'tickets' directory under public storage
            Storage::disk('public')->delete($ticket->file_path);
        }

        // Delete the ticket record
        $ticket->delete();

        // Redirect back with a success message
        return redirect()->route('tickets')->with('success', 'Ticket deleted successfully!');
    }
    public function update(Request $request, Ticket $ticket)
    {
        // Validate the request data
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Update the ticket
        $ticket->update([
            'subject' => $validated['subject'],
            'description' => $validated['description'],
        ]);

        // Redirect with a success message
        return redirect()->route('tickets')->with('success', 'Ticket updated successfully!');
    }
}
