<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Bilietai
            </h2>
            <a href="{{ route('tickets.create') }}" class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                Naujas bilietas
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-flash-message />

            <div class="bg-white p-6 shadow sm:rounded-lg mb-6">
                <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium">Būsena</label>
                        <select name="status" class="mt-1 w-full rounded border-gray-300">
                            <option value="">Visos</option>
                            @foreach(\App\Models\Ticket::statuses() as $key => $label)
                                <option value="{{ $key }}" @selected(request('status') === $key)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Kategorija</label>
                        <select name="category_id" class="mt-1 w-full rounded border-gray-300">
                            <option value="">Visos</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-end gap-2">
                        <button class="rounded bg-gray-800 px-4 py-2 text-white">Filtruoti</button>
                        <a href="{{ route('tickets.index') }}" class="rounded bg-gray-200 px-4 py-2 text-gray-800">Valyti</a>
                    </div>
                </form>
            </div>

            <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Pavadinimas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Kategorija</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Savininkas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Būsena</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Data</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Veiksmai</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($tickets as $ticket)
                            <tr>
                                <td class="px-6 py-4 font-medium">{{ $ticket->title }}</td>
                                <td class="px-6 py-4">{{ $ticket->category->name }}</td>
                                <td class="px-6 py-4">{{ $ticket->user->name }}</td>
                                <td class="px-6 py-4">{{ $ticket->statusLabel() }}</td>
                                <td class="px-6 py-4">{{ $ticket->created_at->format('Y-m-d H:i') }}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a class="text-blue-600" href="{{ route('tickets.show', $ticket) }}">Peržiūrėti</a>

                                    @if(auth()->user()->isAdmin() || auth()->id() === $ticket->user_id)
                                        <a class="text-yellow-600" href="{{ route('tickets.edit', $ticket) }}">Redaguoti</a>
                                        <form method="POST" action="{{ route('tickets.destroy', $ticket) }}" onsubmit="return confirm('Ar tikrai pašalinti?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600">Trinti</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Bilietų nėra.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $tickets->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
