<?php

namespace App\Http\Controllers;

use App\Mail\TicketStatusChangedMail;
use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function index(Request $request): View
    {
        $query = Ticket::with(['user', 'category'])->latest();

        if (!$request->user()->canManageTickets()) {
            $query->where('user_id', $request->user()->id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $tickets = $query->paginate(10)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('tickets.index', compact('tickets', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        return view('tickets.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $validated['user_id'] = $request->user()->id;
        $validated['status'] = Ticket::STATUS_NEW;

        $ticket = Ticket::create($validated);

        return redirect()
            ->route('tickets.show', $ticket)
            ->with('success', 'Bilietas sėkmingai sukurtas.');
    }

    public function show(Ticket $ticket): View
    {
        $this->authorizeView($ticket);

        $ticket->load(['user', 'category', 'comments.user']);
        $statuses = Ticket::statuses();

        return view('tickets.show', compact('ticket', 'statuses'));
    }

    public function edit(Ticket $ticket): View
    {
        $this->authorizeOwnerOrAdmin($ticket);

        $categories = Category::orderBy('name')->get();
        return view('tickets.edit', compact('ticket', 'categories'));
    }

    public function update(Request $request, Ticket $ticket): RedirectResponse
    {
        $this->authorizeOwnerOrAdmin($ticket);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $ticket->update($validated);

        return redirect()
            ->route('tickets.show', $ticket)
            ->with('success', 'Bilietas atnaujintas.');
    }

    public function destroy(Ticket $ticket): RedirectResponse
    {
        $this->authorizeOwnerOrAdmin($ticket);

        $ticket->delete();

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Bilietas pašalintas.');
    }

    public function updateStatus(Request $request, Ticket $ticket): RedirectResponse
    {
        if (!$request->user()->canManageTickets()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => ['required', 'in:' . implode(',', array_keys(Ticket::statuses()))],
        ]);

        $ticket->update(['status' => $validated['status']]);
        $ticket->load('user');

        Mail::to($ticket->user->email)->send(new TicketStatusChangedMail($ticket));

        return back()->with('success', 'Bilieto būsena pakeista.');
    }

    private function authorizeOwnerOrAdmin(Ticket $ticket): void
    {
        $user = auth()->user();

        if (!$user->isAdmin() && $ticket->user_id !== $user->id) {
            abort(403, 'Neturite teisės redaguoti šio bilieto.');
        }
    }

    private function authorizeView(Ticket $ticket): void
    {
        $user = auth()->user();

        if (!$user->canManageTickets() && $ticket->user_id !== $user->id) {
            abort(403, 'Neturite teisės peržiūrėti šio bilieto.');
        }
    }
}
