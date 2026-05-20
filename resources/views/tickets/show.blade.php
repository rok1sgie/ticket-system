<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Bilieto peržiūra</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-flash-message />

            <div class="bg-white p-6 shadow sm:rounded-lg">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-2xl font-bold">{{ $ticket->title }}</h3>
                        <p class="text-gray-600 mt-1">{{ $ticket->category->name }} | {{ $ticket->created_at->format('Y-m-d H:i') }}</p>
                        <p class="text-gray-600">Savininkas: {{ $ticket->user->name }}</p>
                    </div>
                    <span class="rounded bg-blue-100 px-3 py-1 text-blue-800">{{ $ticket->statusLabel() }}</span>
                </div>

                <div class="mt-6 whitespace-pre-line">
                    {{ $ticket->description }}
                </div>

                @if(auth()->user()->isAdmin() || auth()->id() === $ticket->user_id)
                    <div class="mt-6">
                        <a href="{{ route('tickets.edit', $ticket) }}" class="rounded bg-yellow-500 px-4 py-2 text-white">Redaguoti</a>
                    </div>
                @endif
            </div>

            @if(auth()->user()->canManageTickets())
                <div class="bg-white p-6 shadow sm:rounded-lg">
                    <h3 class="font-semibold text-lg mb-4">Keisti būseną</h3>
                    <form method="POST" action="{{ route('tickets.updateStatus', $ticket) }}" class="flex gap-3">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="rounded border-gray-300">
                            @foreach($statuses as $key => $label)
                                <option value="{{ $key }}" @selected($ticket->status === $key)>{{ $label }}</option>
                            @endforeach
                        </select>
                        <button class="rounded bg-blue-600 px-4 py-2 text-white">Atnaujinti</button>
                    </form>
                </div>

                <div class="bg-white p-6 shadow sm:rounded-lg">
                    <h3 class="font-semibold text-lg mb-4">Pridėti komentarą</h3>
                    <form method="POST" action="{{ route('tickets.comments.store', $ticket) }}" class="space-y-4">
                        @csrf
                        <textarea name="comment" rows="4" class="w-full rounded border-gray-300" required>{{ old('comment') }}</textarea>
                        <button class="rounded bg-green-600 px-4 py-2 text-white">Pridėti komentarą</button>
                    </form>
                </div>
            @endif

            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h3 class="font-semibold text-lg mb-4">Komentarai</h3>

                @forelse($ticket->comments as $comment)
                    <div class="border-b py-4">
                        <div class="text-sm text-gray-600">
                            {{ $comment->user->name }} | {{ $comment->created_at->format('Y-m-d H:i') }}
                        </div>
                        <p class="mt-2 whitespace-pre-line">{{ $comment->comment }}</p>
                    </div>
                @empty
                    <p class="text-gray-500">Komentarų nėra.</p>
                @endforelse
            </div>

            <a href="{{ route('tickets.index') }}" class="text-blue-600">Grįžti į sąrašą</a>
        </div>
    </div>
</x-app-layout>
