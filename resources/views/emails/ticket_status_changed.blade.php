<x-mail::message>
# Pasikeitė bilieto būsena

Bilieto **{{ $ticket->title }}** būsena buvo pakeista į: **{{ $ticket->statusLabel() }}**.

<x-mail::button :url="route('tickets.show', $ticket)">
Peržiūrėti bilietą
</x-mail::button>

Pagarbiai,  
{{ config('app.name') }}
</x-mail::message>
