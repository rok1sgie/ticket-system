<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $query = Ticket::query();

        if (!auth()->user()->canManageTickets()) {
            $query->where('user_id', auth()->id());
        }

        $totalTickets = (clone $query)->count();
        $newTickets = (clone $query)->where('status', Ticket::STATUS_NEW)->count();
        $inProgressTickets = (clone $query)->where('status', Ticket::STATUS_IN_PROGRESS)->count();
        $resolvedTickets = (clone $query)->where('status', Ticket::STATUS_RESOLVED)->count();
        $closedTickets = (clone $query)->where('status', Ticket::STATUS_CLOSED)->count();

        $latestTickets = (clone $query)
            ->with(['user', 'category'])
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalTickets',
            'newTickets',
            'inProgressTickets',
            'resolvedTickets',
            'closedTickets',
            'latestTickets'
        ));
    }
}