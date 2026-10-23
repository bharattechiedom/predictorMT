<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('company_id', Auth::user()->company_id)
            ->with('user')
            ->latest()
            ->paginate(15);
        return view('user.support.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        if ($ticket->company_id !== Auth::user()->company_id) abort(403);
        return view('user.support.show', compact('ticket'));
    }

    public function create()
    {
        return view('user.support.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'nullable|in:low,medium,high',
        ]);

        $validated['company_id'] = Auth::user()->company_id;
        $validated['user_id'] = Auth::id();

        Ticket::create($validated);

        return redirect()->route('user.support.index')->with('success', 'Support ticket created');
    }

    public function destroy(Ticket $ticket)
    {
        if ($ticket->company_id !== Auth::user()->company_id) abort(403);
        $ticket->delete();
        return redirect()->route('user.support.index')->with('success', 'Ticket deleted');
    }
}
