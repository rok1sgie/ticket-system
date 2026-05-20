<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kategorijos</h2>
            <a href="{{ route('categories.create') }}" class="rounded bg-blue-600 px-4 py-2 text-white">Nauja kategorija</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <x-flash-message />

            <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Pavadinimas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Bilietų kiekis</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Veiksmai</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($categories as $category)
                            <tr>
                                <td class="px-6 py-4">{{ $category->name }}</td>
                                <td class="px-6 py-4">{{ $category->tickets_count }}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="{{ route('categories.edit', $category) }}" class="text-yellow-600">Redaguoti</a>
                                    <form method="POST" action="{{ route('categories.destroy', $category) }}" onsubmit="return confirm('Ar tikrai pašalinti?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600">Trinti</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
