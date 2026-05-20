<x-mail::message>
# Pridėtas naujas komentaras

Prie bilieto **{{ $ticket->title }}** pridėtas komentaras:

> {{ $comment->comment }}

<x-mail::button :url="route('tickets.show', $ticket)">
Peržiūrėti bilietą
</x-mail::button>

Pagarbiai,  
{{ config('app.name') }}
</x-mail::message>
