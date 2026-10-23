<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::with(['company','user'])->latest()->paginate(15);
        return view('admin.tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::orderBy('name')->get(['id','name']);
        $users = User::orderBy('name')->get(['id','name']);
        return view('admin.tickets.create', compact('companies','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'user_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:open,pending,resolved,closed',
            'priority' => 'required|in:low,medium,high',
        ]);

        $ticket = Ticket::create($validated);
        return redirect()->route('admin.tickets.show', $ticket)->with('success', 'Ticket created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        $ticket->load(['company','user']);
        return view('admin.tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        $companies = Company::orderBy('name')->get(['id','name']);
        $users = User::orderBy('name')->get(['id','name']);
        return view('admin.tickets.edit', compact('ticket','companies','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'user_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:open,pending,resolved,closed',
            'priority' => 'required|in:low,medium,high',
        ]);

        $ticket->update($validated);
        return redirect()->route('admin.tickets.show', $ticket)->with('success', 'Ticket updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('admin.tickets.index')->with('success', 'Ticket deleted.');
    }
}
