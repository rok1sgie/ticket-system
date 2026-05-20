<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class ReportController extends Controller
{
    public function activeTickets(): Response
    {
        $tickets = Ticket::with(['user', 'category'])
            ->whereNotIn('status', [Ticket::STATUS_RESOLVED, Ticket::STATUS_CLOSED])
            ->latest()
            ->get();

        $pdf = Pdf::loadView('reports.active_tickets', compact('tickets'));

        return $pdf->download('aktyvus-bilietai.pdf');
    }
}
