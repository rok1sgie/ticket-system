<?php

namespace App\Http\Controllers;

use App\Mail\TicketCommentAddedMail;
use App\Models\Ticket;
use App\Models\TicketComment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TicketCommentController extends Controller
{
    public function store(Request $request, Ticket $ticket): RedirectResponse
    {
        if (!$request->user()->canManageTickets()) {
            abort(403, 'Tik palaikymo personalas arba administratorius gali pridėti komentarus.');
        }

        $validated = $request->validate([
            'comment' => ['required', 'string', 'max:5000'],
        ]);

        $comment = TicketComment::create([
            'ticket_id' => $ticket->id,
            'user_id' => $request->user()->id,
            'comment' => $validated['comment'],
        ]);

        $ticket->load('user');

        Mail::to($ticket->user->email)->send(new TicketCommentAddedMail($ticket, $comment));

        return back()->with('success', 'Komentaras pridėtas.');
    }
}
